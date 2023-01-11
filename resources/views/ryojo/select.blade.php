
<x-layoutgray title="旅情　-美しい日本を投稿しよう- 画像編集確認">
<p class="text-center mt-24  text-lg text-gray-800">画像を編集しますか？</p>
    <div class="md:w-[650px] w-11/12 h-[400px] m-auto mt-4 border-4 border-gray-400 bg-white rounded-lg">
        <p class="mt-16 mb-10 text-center text-gray-800">現在投稿されている画像</p>
        <x-ryojo.images :images="$memory->images"/>
    </div>

    <div class="w-1/2 md:w-2/5 my-20 mx-auto"> 
        <a href="{{ route('ryojo.update.imageform',['memoryId' => $memory->id]) }}" class="block py-3 bg-[#1e3333] hover:bg-[#001a1a] text-center text-white rounded-lg">編集する</a>
        <p class="mt-2 mb-10 text-center text-sm text-gray-800">※画像は最初から選び直していただく必要があります</p>                               
        <a href="{{ route('ryojo.update.textconfirm',['memoryId' => $memory->id]) }}" class="block mb-20 py-3 bg-[#1e3333] hover:bg-[#001a1a] text-center text-white rounded-lg">このまま次へ</a>       
    </div> 
   
</x-layoutgray>
