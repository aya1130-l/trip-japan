<x-layoutgray title="旅情　-美しい日本を投稿しよう- お気に入り">
    <!--サイドバー-->
    <div class="invisible md:visible z-20 fixed w-1/5 min-h-screen bg-[#001a1a]">
        <ul class="mx-8 my-12 text-white text-[32px]">
            @if(!Auth::check())
                <li><a href="{{ route('register.precheck') }}" class="block py-2 mb-4 rounded bg-opacity-80 hover:bg-opacity-100 bg-gray-100 text-center text-[#001a1a] text-[16px]">新規登録</a></li>
                <li><a href="{{ route('login') }}" class="block py-2 mb-8 rounded bg-opacity-80 hover:bg-opacity-100 bg-gray-100 text-center text-[#001a1a] text-[16px]">ログイン</a></li>
            @endif
            <li class="mb-4 hover:underline decoration-1 truncate"><a href="{{ route('ryojo.index') }}"><i class="fa fa-home text-white" aria-hidden="true"></i> Home</a></li></label>
            <li class="mb-4 hover:underline decoration-1 truncate"><a href="{{ route('ryojo.mypage') }}"><i class="fa fa-user text-white" aria-hidden="true"></i> MyPage</a></li>
            <li class="mb-4 hover:underline decoration-1 truncate"><a href="{{ route('ryojo.mypage.Updateform') }}"><i class="fa fa-cog text-white" aria-hidden="true"></i> Account</a></li>
            <li class="mb-4 hover:underline decoration-1 truncate"><a href="{{ route('ryojo.bookmark') }}"><i class="fa fa-heart text-white" aria-hidden="true"></i> Bookmark</a></li>
            <li class="mb-4 hover:underline decoration-1 truncate"><a href="{{ route('ryojo.form') }}"><i class="fa fa-plus-square text-white" aria-hidden="true"></i> Post</a>
            @if(Auth::check())
                <li><form action="{{ route('logout') }}" method="post"><button type="submit" class="ml-2 text-white text-[16px] hover:text-gray-300">ログアウト</button></form></li>
            @endif 
        </ul>
    </div>

     <!--header-->
     <div class="visible md:invisible z-0 bg-[#001a1a] 100vl h-[50px]">
        @if(Auth::check())
        <form action="{{ route('logout') }}" method="post"><button type="submit" class="absolute right-[5%] top-[2%] text-white">ログアウト</button></form>
        @else
        <div class="absolute top-[15px] right-[10px]">
            <a href="{{ route('register.precheck') }}" class="z-10 mr-4 text-white">新規登録</a>
            <a href="{{ route('login') }}" class="z-10 mr-4 text-white">ログイン</a> 
        </div>
        @endif
    </div>

    <!--memory-->
    <div class="md:absolute md:left-[20%] md:top-[4%] lg:w-[725px] md:w-3/5 mt-5 mx-4 md:mx-10 mb-20">
        @foreach($bookmarkMemories as $bookmarkMemory)
            <div class="md:mb-10 my-5 border border-gray-500 bg-white border-2 md:rounded-lg rounded-xl">
                <div class="mx-5 md:mt-8 mt-6 md:mb-4 mb-4">
                    <div class="items-end border-b border-gray-200">
                        <p class="font-bold text-[24px] text-gray-800 truncate">{{ $bookmarkMemory->title }}</p>
                        <button type="button" onclick="location.href='{{ route('ryojo.userpage',['userId' => $bookmarkMemory->user_id]) }}'" class="block ml-auto text-right text-gray-800 truncate">{{ $bookmarkMemory->user->name }}</button>
                    </div>

                    <div class="md:flex">    
                        <div class="md:w-3/5">
                            <div class="flex mt-3">
                                <img src="/src/image/日本地図.png" class="w-5 h-5 mr-2">  
                                @foreach($bookmarkMemory->prefectures as $prefecture)                         
                                    <span class="whitespace-nowrap mr-1 text-[14px] text-gray-600">{{ $prefecture->prefectures }}</span>
                                @endforeach
                            </div>

                            <div class="flex">                                
                                <img src="/src/image/タグ.png" class="w-5 h-5 mt-2 mr-2"> 
                                @foreach($bookmarkMemory->tags as $tag)
                                    <span class="mt-2 mr-1 text-[14px] text-gray-600">{{ $tag->tagname }} </span>
                                @endforeach
                            </div>

                            <div>
                                <p class="mx-2 mt-3 break-words text-gray-800">{{ mb_substr($bookmarkMemory->content,0,50) }}...</p>  
                                <a href="{{ route('ryojo.memory',['memoryId' => $bookmarkMemory->id]) }}" class="mx-2 text-gray-800 text-[12px]">全文を表示</a><!--下からの距離に直す-->
                            </div>
                        </div>

                        <div class="md:w-2/5">
                            @foreach($bookmarkMemory->images as $image)
                                <img alt="{{ $image->name }}" class="object-contain m-auto md:mt-2 w-[250px]" src="{{ image_url($image->name) }}"> 
                                @break
                            @endforeach
                        </div>
                    </div> 

                    <div class="flex justify-start">
                            <div x-data="ajax()">
                                @if(in_array($bookmarkMemory->id,$bookmarkMemoriesId,true))<!--お気に入りされている状態-->
                                    <i class="fas fa-heart cursor-pointer text-red-500 ml-1" @click="createPost" id="{{ $bookmarkMemory->id }}"></i>
                                    <span class="text-[14px] text-gray-600 mr-10">{{ $bookmarkMemory->bookmarks_count }}</span>
                                @else<!--お気に入りされていない状態-->
                                    <i class="fas fa-heart cursor-pointer text-gray-600 ml-1" @click="createPost" id="{{ $bookmarkMemory->id }}"></i>
                                    <span class="text-[14px] text-gray-600 mr-10">{{ $bookmarkMemory->bookmarks_count }}</span>
                                @endif
                            </div>

                            @if(\Illuminate\Support\Facades\Auth::id() === $bookmarkMemory->user_id)
                                <a class="flex mt-1 mr-12" href="{{ route('ryojo.update.textform',['memoryId' => $bookmarkMemory->id]) }}">
                                    <i class="fa fa-edit text-gray-600"></i>
                                    <span class="text-[14px] text-gray-600"></span>
                                </a>
                                <div x-data="{ open : false }">
                                    <button @click="open = true" type="submit" class="text-[14px] text-gray-600"><i class="fa fa-trash text-gray-600"></i></button>
                                    <!--delete確認モーダル-->
                                    <div x-show="open" class="z-30 fixed top-0 left-0 w-screen h-screen" x-cloak>
                                        <div class="top-o left-0 bg-black bg-opacity-80 w-screen h-screen">
                                            <div class="relative w-5/6 max-w-md h-1/3 m-auto bg-gray-100 border rounded-md shadow"
                                                style="top: 30vh; grid-template-rows: 4rem 1fr 6rem;">
                                                <p class="text-gray-800 text-center mt-16">{{ $bookmarkMemory->title }}を削除します。<br>よろしいですか？</p>
                                                <form class="flex justify-center mt-8" action="{{ route('ryojo.delete',['memoryId' => $bookmarkMemory->id]) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf                                
                                                    <button type="submit" class="px-4 py-1.5 mr-8 rounded-md bg-gray-800 hover:bg-gray-600 text-[14px] text-white">削除する</button>
                                                    <a @click="open = false" class="px-4 py-2 rounded-md text-[14px] bg-gray-800 hover:bg-gray-600 text-white cursor-pointer">キャンセル</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            @endif
                            <div class="ml-auto text-gray-800 text-sm">{{ $bookmarkMemory->created_at }}</div>
                    </div>   
                </div>                               
            </div>           
        @endforeach
    </div>
    
        <div class="md:hidden fixed flex justify-around z-0 bottom-0 h-16 w-screen bg-gray-100">
            <a class="block px-2 py-1.5 mt-2" href="{{ route('ryojo.index') }}"><i class="fa fa-home fa-2x hover:text-gray-600" aria-hidden="true"></i></a>
            <a class="block px-2 py-1.5 mt-2" href="{{ route('ryojo.form') }}"><i class="fa fa-plus-square fa-2x hover:text-gray-600" aria-hidden="true"></i></a>
            <a class="block px-2 py-1.5 mt-2" href="{{ route('ryojo.bookmark') }}"><i class="fa fa-heart fa-2x hover:text-gray-600" aria-hidden="true"></i></a>
            <a class="block px-2 py-1.5 mt-2" href="{{ route('ryojo.mypage') }}"><i class="fa fa-user fa-2x hover:text-gray-600" aria-hidden="true"></i></a>
        </div>
</x-layoutgray>

<script>
function ajax() { 
    return {
    bookmarkUrl: "{{ route('ryojo.bookmark.create') }}",
    createPost(e) {
        let memoryId = e.target.id;
        fetch(this.bookmarkUrl, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
            'X-CSRF-TOKEN': '<?= csrf_token() ?>',
        },
        body: JSON.stringify({ memory_id:memoryId }),
        redirect: 'error',
        })
        .then(response => {
            return response.json();
        })
        .then(data => { 
            e.target.classList.toggle('text-red-500');
            e.target.nextElementSibling.textContent = data.bookmarksCount;
        })
        .catch(error => {
            window.location.href = 'http://localhost/register/precheck';
        });//戻り値はpromise,responseインターフェースのメソッド
     },       
    }
}
</script>

