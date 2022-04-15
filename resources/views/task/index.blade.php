<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои заявки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                                                    Статус</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Создан</th>
                                            </tr>
                                            </thead>
                                            @endif
                                            <tbody class="bg-white text-center">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->id }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->theme }}
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    {{ $task->getStatus() }}
                                                </td>

                                                <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                    <span>{{ date('d-m-Y h:i', strtotime($task->created_at)) }}</span>
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
