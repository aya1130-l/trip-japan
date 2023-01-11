<x-layoutgray title="旅情　-プロフィールの編集-">
    <p class="text-center mt-24  text-lg text-gray-800">< プロフィールの編集 ></p>
        <div class="relative w-11/12 md:w-[650px] min-h-[400px] m-auto mt-4 border-4 border-gray-400 bg-white rounded-lg">
            <div class="m-auto mt-4 w-5/6">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            <form action="{{ route('ryojo.mypage.update') }}" method="post">
            @method('PUT')
            @csrf
                <div class="m-auto mt-8 w-5/6">
                    <p class="text-gray-800">name:</p>
                    <textarea type="text" name="name" class="block border-2 border-gray-300 w-full rounded resize-none h-12">{{ $user->name }}</textarea>
                </div>

                <div class="m-auto my-8 w-5/6">
                    <p class="text-gray-800">profile:</p>
                    <textarea name="profile" class="block border-2 border-gray-300 w-full h-44 rounded resize-none">{{ $user->profile }}</textarea>
                </div>
        </div>
            
        <div class="w-1/2 md:w-1/4 h-12 m-auto mt-20 mb-8 bg-[#001a1a] hover:bg-[#1e3333] text-center text-white rounded-lg">
            <button type="submit" class="h-12">更新する</button>
        </div> 
        <a href="{{ route('ryojo.index') }}" class="block w-1/2 md:w-1/4 h-12 mx-auto mb-20 py-3 bg-[#b3a7a1] hover:bg-[#ccc1b8] text-center text-white rounded-lg">TOPに戻る</a>           
</x-layoutgray>