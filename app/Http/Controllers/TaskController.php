<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Archive;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class TaskController extends Controller
{
    public function index()
    {
        $taskStat1 = Task::where('task_status_id', 1)->get();
        $taskStat2 = Task::where('task_status_id', 2)->get();
        $taskStat3 = Task::where('task_status_id', 3)->get();
        $taskStat4 = Task::where('task_status_id', 4)->get();

        return Inertia::render('Task/Index', [
            'users' => User::with('tasks')->orderBy('nickname', 'asc')->get(),
            'departments' => Department::all(),
            'positions' => Position::all(),
            'roles' => Role::all(),
            'tasks' => Task::with('users')->get(),
            'statuses' => Status::all(),
            'taskStat1' => $taskStat1,
            'taskStat2' => $taskStat2,
            'taskStat3' => $taskStat3,
            'taskStat4' => $taskStat4,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Task/Create', [
            'users' => User::orderBy('nickname', 'asc')->get(),
            'departments' => Department::all(),
            'positions' => Position::all(),
            'roles' => Role::all(),
            'statuses' => Status::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $item = $request->validated();
        $users = $item['users'];

        // для архива
        $usersForArchive = User::whereIn('id', $users)->get();
        $usersNamesForArchive = $usersForArchive->pluck('name');
        $usersSurnamesForArchive = $usersForArchive->pluck('surname');
        $usersNicknamesForArchive = $usersForArchive->pluck('nickname');
        $combinedUsers = $usersSurnamesForArchive->map(function ($surname, $index) use ($usersNamesForArchive, $usersNicknamesForArchive) {
            $name = $usersNamesForArchive[$index] ?? '';
            $nickname = $usersNicknamesForArchive[$index] ?? '';
            return "$surname $name ($nickname)";
        });
        $resultFullNameForArchive = $combinedUsers->implode(', '); //фамилия, имя (ник) - строка
        // для архива - конец

        unset($item['users']);
        $task = Task::create($item);
        $task->users()->attach($users);

        $taskForArchive = Task::all()->last(); // последняя (только что созданная задача) (для архива)
        $taskIdForArchive = $taskForArchive['id']; // ID созданной задачи (для архива)
        Archive::create([
            'task_id' => $taskIdForArchive,
            'users_string' => $resultFullNameForArchive,
        ]); //создание задачи в архиве
    }

    public function show(Task $task)
    {
        $users = $task->users;
        $statuses = Status::all();
        $createDate = date('d.m.Y', strtotime($task->created_at));
        $createTime = $task->created_at->format('h:i:s');
        $updateDate = date('d.m.Y', strtotime($task->updated_at));
        $updateTime = $task->updated_at->format('h:i:s');

        return Inertia::render('Task/Show', [
            'task' => $task,
            'createDate' => $createDate,
            'createTime' => $createTime,
            'updateDate' => $updateDate,
            'updateTime' => $updateTime,
            'statuses' => $statuses,
            'users' => $users,
        ]);
    }

    public function edit(Task $task)
    {
        $users = User::orderBy('nickname', 'asc')->get();
        $usersTask = $task->where('id', $task->id)->with('users')->get();
        return Inertia::render('Task/Edit', [
            'users' => $users,
            'task' => $task,
            'usersTask' => $usersTask,
        ]);
    }

    public function update(Task $task, UpdateRequest $request)
    {
        $item = $request->validated();
        $users = $item['users'];
        unset($item['users']);
        $task->update($item);
        $task->users()->sync($users);
    }

    public function destroy(Task $task)
    {
        //обновление архива:
        $correctDateFormat = date('Y-m-d H:i:s', strtotime($task->task_date));
        $correctDeadlineFormat = date('Y-m-d H:i:s', strtotime($task->deadline));

        $tasksArchive = Archive::where('task_id', $task->id)->get();
        if ($tasksArchive->count() > 0) {
            $tasksArchive->each(function ($archive) use ($correctDateFormat, $correctDeadlineFormat, $task) {
                $archive->update([
                    'task_date' => $correctDateFormat,
                    'number' => $task->number,
                    'task_name' => $task->task_name,
                    'item' => $task->item,
                    'task' => $task->task,
                    'note' => $task->note,
                    'done' => $task->done,
                    'comment' => $task->comment,
                    'deadline' => $correctDeadlineFormat,
                    'task_status_id' => $task->task_status_id,
                ]);
            });
        }
        //обновление архива - конец

        $users = $task['users'];
        unset($task['users']);
        $task->users()->detach($users);
        $task->delete();
        return redirect()->route('task.index');
    }


    // копирование задач:
    public function copy(int $id)
    {
        $users = User::all();
        $tasks = Task::find($id)->with('users')->get();
        $task = $tasks->find($id);
        return Inertia::render('Task/Copy', [
            'users' => $users,
            'task' => $task,
        ]);
    }


    // экспорт задач в Excel:
    public function download(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        // данные (шапка):
        $activeWorksheet
            ->setCellValue('A1', 'ID#')
            ->setCellValue('B1', 'Дата задачи')
            ->setCellValue('C1', 'Номер документа')
            ->setCellValue('D1', 'Наименование документа')
            ->setCellValue('E1', 'Пункт')
            ->setCellValue('F1', 'Текст поручения')
            ->setCellValue('G1', 'Примечание')
            ->setCellValue('H1', 'Дата исполнения')
            ->setCellValue('I1', 'Исполнители');


        // шрифт шапки:
        $activeWorksheet->getStyle('A1:I1')->getFont()->setSize(12)->setBold(true);
        $activeWorksheet->getStyle('G')->getFont()->setItalic(true);

        // стили ячеек:
        $activeWorksheet->getStyle('A:I')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $activeWorksheet->getStyle('A:I')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $activeWorksheet->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('add8e6');
        $activeWorksheet->getStyle('A2:I2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('BABABA');
        $activeWorksheet->getStyle('F:I')->getAlignment()->setWrapText(true);

        // ширина столбцов:
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(13);
        $activeWorksheet->getColumnDimension('C')->setWidth(19);
        $activeWorksheet->getColumnDimension('D')->setWidth(28);
        $activeWorksheet->getColumnDimension('E')->setWidth(8);
        $activeWorksheet->getColumnDimension('F')->setWidth(90);
        $activeWorksheet->getColumnDimension('G')->setWidth(30);
        $activeWorksheet->getColumnDimension('H')->setWidth(18);
        $activeWorksheet->getColumnDimension('I')->setWidth(25);

        // данные (задачи):
        $taskDownloadIds = $request->input('taskDownloadIds');
        $tasks = Task::whereIn('id', $taskDownloadIds)->get();
        $row = 3;
        foreach ($tasks as $task) {
            $usersString = '';
            foreach ($task['users'] as $item) {
                $usersString .= $item['nickname'] . '(' . $item['surname'] . ' ' . $item['name'] . ')' . ', ';
            }
            $users = rtrim($usersString, ', ');

            $activeWorksheet
                ->setCellValue('A' . $row, $task->id)
                ->setCellValue('B' . $row, date('d.m.Y', strtotime($task->task_date)))
                ->setCellValue('C' . $row, $task->number)
                ->setCellValue('D' . $row, $task->task_name)
                ->setCellValue('E' . $row, $task->item)
                ->setCellValue('F' . $row, $task->task)
                ->setCellValue('G' . $row, $task->note)
                ->setCellValue('H' . $row, date('d.m.Y', strtotime($task->deadline)))
                ->setCellValue('I' . $row, $users);

            $row++;
        }


        // переменные для имени файла:
        $fileNameDate = date("Y-m-d");
        $fileNameTime = date("H-i");

        $writer = new Xlsx($spreadsheet);
        $writer->save('downloads/' . 'задачи от ' . $fileNameDate . ' в ' . $fileNameTime . '.xlsx');

        return 'задачи успешно выгружены';


    }

}
