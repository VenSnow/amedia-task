<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Заявки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('status'))
                        <div class="mt-2 mb-4">
                            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                                <p class="font-bold">Оповещение</p>
                                <p class="text-sm">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif
                    @forelse($tasks as $task)
                        @if($loop->first)
                            <div class="flex flex-col mb-4">
                                <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                                    <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                        <table class="w-full">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    ID</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Тема</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Автор</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Имя</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Email</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Статус</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Создан</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Действие</th>
                                            </tr>
                                            </thead>
                                            @endif
                                            <tbody class="bg-white text-center">
                                            <tr class="@if($task->isDone()) bg-green-100 border-t border-b border-green-500 text-green-700 @endif">
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->id }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->theme }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->user->name }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->user_name }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->client_email }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->getStatus() }}
                                                </td>

                                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <span>{{ date('d-m-Y h:i', strtotime($task->created_at)) }}</span>
                                                </td>

                                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    @if($task->isDone())
                                                        <button class="px-6 py-2 mr-2 text-sm font-semibold rounded-md shadow-md text-gray-100 bg-gray-500 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300" disabled>Ответить</button>
                                                    @else
                                                        <form action="{{ route('manager.task.change', $task) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="px-6 py-2 mr-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300" type="submit">
                                                                Ответить
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>

                                            </tr>
                                            </tbody>
                                            @if($loop->last)
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{ $tasks->links() }}
                        @endif
                    @empty
                        Заявки отсутствуют
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
