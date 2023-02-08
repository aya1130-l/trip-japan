<x-layoutgray title="旅情　-美しい日本を投稿しよう- 旅行記詳細">

<!--サイドバー-->
    <div class="invisible md:visible z-20 fixed w-1/5 min-h-screen bg-[#001a1a]">
        <ul class="mx-8 my-12 text-white text-[32px]">
            @if(!Auth::check())
            <li><a href="{{ route('register.precheck') }}" class="block py-2 mb-4 rounded bg-opacity-80 hover:bg-opacity-100 bg-gray-100 text-center text-[#001a1a] text-[16px]">新規登録</a></li>
                <li><a href="{{ route('login') }}" class="block py-2 mb-4 rounded bg-opacity-80 hover:bg-opacity-100 bg-gray-100 text-center text-[#001a1a] text-[16px]">ログイン</a></li>
                <li><form action="{{ route('guestlogin') }}" method="post">
                    @csrf
                    <button type="submit" class="block w-full py-2 mb-8 rounded bg-opacity-80 hover:bg-opacity-100 bg-gray-100 text-center text-[#001a1a] text-[16px]">ゲストログイン</button>
                </form></li>
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
        <div class="flex items-center absolute top-[15px] right-[10px]">
            <a href="{{ route('register.precheck') }}" class="z-10 mr-4 text-white text-sm">新規登録</a>
            <a href="{{ route('login') }}" class="z-10 mr-4 text-white text-sm">ログイン</a>
            <form action="{{ route('guestlogin') }}" method="post">
                @csrf
                <button type="submit" class="z-10 mr-4 text-yellow-400 text-sm">ゲストログイン</button>
            </form>
        </div>
        @endif
    </div>

    <!--memory-->
    <div class="md:absolute md:left-[20%] md:top-[4%]">
        <div class="mx-4 md:mx-8 mt-5 mb-20 border border-gray-500 border-2 rounded-lg bg-white">
            <div class="mx-4 md:mx-12 mt-6">
                <div class="flex items-end border-b border-gray-200">
                    <p class="w-5/6 mr-2 font-bold text-[28px] text-gray-800">{{ $memory->title }}</p>
                    <a href="{{ route('ryojo.userpage',['userId' => $memory->user->id]) }}" class="block w-1/6 break-words ml-auto text-right text-gray-800">{{ $memory->user->name }}</a>
                </div>

                <img src="/src/image/日本地図.png" class="inline-block w-5 h-5 mr-1">  
                @foreach($memory->prefectures as $prefecture)                         
                    <span class="mt-2 mr-1 text-[14px] text-gray-600 whitespace-nowrap">{{ $prefecture->prefectures }}</span>
                @endforeach

                <div>             
                    <img src="/src/image/タグ.png" class="inline-block w-5 h-5 mr-1"> 
                    @foreach($memory->tags as $tag) 
                        <span class="mt-2 mr-1 text-[14px] text-gray-600 whitespace-nowrap">{{ $tag->tagname }} </span>
                    @endforeach
                </div>

                <x-ryojo.bigimages :images="$memory->images"/>


                <p class="mx-2 mt-3 break-words whitespace-pre-wrap text-gray-800">{{ $memory->content }}</p>  

                <div class="flex justify-end items-middle mt-8 mb-2 md:w-3/4">
                    <div x-data="ajax()" class="pr-5 whitespace-nowrap break-words truncate w-full">
                        @if(in_array($memory->id,$bookmarkMemoriesId,true))<!--お気に入りされている状態-->
                            <i class="fas fa-heart cursor-pointer text-red-500 ml-1" @click="createPost" id="{{ $memory->id }}"></i>
                            <span class="text-[14px] text-gray-600">お気に入り{{ $memory->bookmarks_count }}</span>
                        @else<!--お気に入りされていない状態-->
                            <i class="fas fa-heart cursor-pointer text-gray-600 ml-1" @click="createPost" id="{{ $memory->id }}"></i>
                            <span class="text-[14px] text-gray-600">お気に入り{{ $memory->bookmarks_count }}</span>
                        @endif
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::id() === $memory->user_id)
                    <a class="block whitespace-nowrap break-words truncate w-full" href="{{ route('ryojo.update.textform',['memoryId' => $memory->id]) }}">
                        <i class="fa fa-edit text-gray-600"></i>
                        <span class="text-[14px] text-gray-600">編集する</span>
                    </a>
                        
                    <form action="{{ route('ryojo.delete',['memoryId' => $memory->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <label for="delete" class="cursor-pointer whitespace-nowrap break-words truncate w-full">                                
                            <button type="submit" id="delete" class="text-[14px] text-gray-600"><i class="fa fa-trash text-gray-600"></i></button>
                            <span id="delete" class="text-[14px] text-gray-600">削除する</span>
                        </label>
                    </form>
                    @else
                    @endif                  
                </div>  
                <p class="mb-6 text-right text-gray-800 text-sm">{{ $memory->created_at }}</p>                                  
                </div>
            </div>                                
            </div> 
        </div>
    </div> 
     
    <!--スマホ版画面下-->
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
            e.target.nextElementSibling.textContent = 'お気に入り'+data.bookmarksCount;
        })
        .catch(error => {
            window.location.href = "{{ route('register.precheck') }}";
        });//戻り値はpromise,responseインターフェースのメソッド
     },       
    }
}
</script>





    