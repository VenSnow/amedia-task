<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Создать заявку
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
                    @if(isset($message) && $message != "")
                            <div class="mt-2 mb-4">
                                <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
                                    <p class="font-bold">Оповещение</p>
                                    <p class="text-sm">{{ $message }}</p>
                                </div>
                            </div>
                    @endif
                    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700" for="theme">
                                Тема
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 @error('theme') border-red-800 @enderror rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="theme" placeholder="Тема" value="{{ old('theme') }}" required />
                            @error('theme')
                                <p class="text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700" for="message">
                                Сообщение
                            </label>

                            <textarea
                                class="block w-full mt-1 border-gray-300 @error('message') border-red-800 @enderror rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="message" placeholder="Сообщение" rows="5" required >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700" for="user_name">
                                Ваше имя
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 @error('user_name') border-red-800 @enderror rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="text" name="user_name" placeholder="Введите ваше имя" value="{{ old('user_name') ?? auth()->user()->name }}" required />
                            @error('user_name')
                                <p class="text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700" for="client_email">
                                Email
                            </label>

                            <input
                                class="block w-full mt-1 border-gray-300 @error('client_email') border-red-800 @enderror rounded-md shadow-sm placeholder:text-gray-400 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                type="email" name="client_email" placeholder="Введите ваш email" value="{{ old('client_email') ?? auth()->user()->email }}" required />
                            @error('client_email')
                                <p class="text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700" for="file">
                                Прикрепить файл
                            </label>

                            <input class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding @error('client_email')border border-red-800 @enderror rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" name="file" placeholder="Выберите файл" required>
                            @error('file')
                                <p class="text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-start mt-4 gap-x-2">
                            <button type="submit" class="px-6 py-2 mr-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                                Отправить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
