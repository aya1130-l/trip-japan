<x-layoutgray title="旅情　-画像の編集-">
    <p class="text-center mt-24  text-lg text-gray-800">< 画像の編集 ></p>
    <div class="md:w-[650px] w-11/12 min-h-[400px] m-auto mt-4 border-4 border-gray-400 bg-white rounded-lg">
        <div class="m-auto mt-4 w-5/6">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <form action="{{ route('ryojo.update.imageconfirm',['memoryId' => $memory->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="my-12 text-center">
                <x-ryojo.form.images></x-ryojo.form.images>
            </div>
    </div>
    <button type="submit" class="block w-1/2 md:w-1/4 h-12 m-auto my-20 bg-[#001a1a] hover:bg-[#1e3333] text-center text-white rounded-lg">次へ</button>
</x-layoutgray>

