<x-layoutgray title="旅情　-美しい日本を投稿しよう- 投稿確認">
    
    <p class="mt-16 text-center text-gray-800">この内容で投稿します。よろしいですか？</p>

    <div class="w-11/12 md:w-3/5 my-10 mx-auto border border-gray-500 border-2 rounded-lg bg-white">
        <div class="md:mx-12 md:my-8 mx-6 my-4">
                <p class="border-b border-gray-200 mr-2 font-bold text-[24px] text-gray-800">{{ $title }}</p>

            <div class="flex mt-3">
                <img src="/src/image/日本地図.png" class="w-5 h-5 mr-2">  
                @foreach($prefs as $pref)                         
                    <span class="mr-1 text-[14px] text-gray-600">{{ $pref->prefectures }}</span>
                @endforeach
            </div>

            <div class="flex">                                
                <img src="/src/image/タグ.png" class="w-5 h-5 mt-2 mr-2"> 
                @foreach($tags as $tag)
                    <span class="mt-2 mr-1 text-[14px] text-gray-600">{{ $tag->tagname }} </span>
                @endforeach
            </div>
        
            <x-ryojo.tmpimages :newImagesPath="$newImagesPath"/>
            <p class="mx-2 mt-10 break-words whitespace-pre-wrap text-gray-800">{{ $content }}</p>  
        </div>
    </div>


    <div class="my-20">
        <form action="{{ route('ryojo.create') }}" method="post" enctype="multipart/form-data" class="w-full mb-10"> 
                @csrf
                <button type="submit" class="block w-1/2 md:w-2/5 h-12 px-3 mt-5 mx-auto py-3 bg-[#001a1a] hover:bg-[#1e3333] text-center text-white rounded-lg font-bold">投稿する</button>
        </form>
        <div class="w-full">
            <a href="{{ route('ryojo.revise') }}" class="block w-1/2 h-12 md:w-2/5 text-center mx-auto px-3 py-3 bg-[#001a1a] hover:bg-[#1e3333] text-white font-bold rounded-lg">修正する</a>
            <p class="mt-2 text-center text-[14px] text-gray-800">※画像は最初から選び直していただく必要があります</p>
        </div>       
    </div>                                 
</x-layoutgray>