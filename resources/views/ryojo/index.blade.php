<x-layoutgray title="旅情　-美しい日本を投稿しよう- 投稿一覧">

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


    <!--search-->
    <div class="md:absolute md:left-[20%] md:top-[4%] lg:w-1/2 md:w-3/4 mt-5 mx-4 md:mx-10 mb-20">
        <form method="GET" action="{{ route('ryojo.index') }}" class="mb-5">
            <div class="flex">
                <input type="text" placeholder="キーワード検索" name="search" value="@if (isset($search)) {{ $search }} @endif" class="block md:w-1/2 w-full border-2 border-gray-300 rounded resize-none h-10">
                <button type="submit" class="ml-2 px-6 md:mr-2 rounded-lg text-sm text-center text-white bg-[#16284d] hover:bg-gray-600"><i class="fa fa-search" aria-hidden="true"></i></button>
                <a href="{{ route('ryojo.index') }}" class="inline-block md:mt-3 w-24 text-gray-800 text-sm text-center underline">条件<br class="md:hidden">クリア</a>
            </div>

            <div x-data="setPrefectures()" class="my-3">
                <a tabindex="0" @click="all = ! all" class="relative text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center pointer-events-auto cursor-pointer">都道府県<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                <span x-text="prefectures" class="text-gray-800 text-sm"></span>
                <div x-cloak x-show="all">
                    <div class="bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                        <ul class="py-1 divide-y divide-gray-100 text-sm text-gray-700 dark:text-gray-200">
                            <li class="pointer-events-auto relative">
                                <button @click="tohoku = ! tohoku" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">北海道・東北地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='tohoku' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" tohoku = ''">
                                @foreach($Tohokuprefs as $pref)                                             
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="kanto = ! kanto" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">関東地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='kanto' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" kanto = ''">
                                @foreach($Kantoprefs as $pref)
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="chubu = ! chubu" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">中部地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='chubu' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" chubu = ''">
                                    @foreach($Chubuprefs as $pref) 
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                    @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="kinki = ! kinki" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">近畿地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='kinki' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" kinki = ''">
                                    @foreach($Kinkiprefs as $pref)                       
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="leading-7 w-6 h-6 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></span>
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                    @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="chugoku = ! chugoku" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">中国地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='chugoku' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" chugoku = ''">
                                    @foreach($Chugokuprefs as $pref) 
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                    @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="shikoku = ! shikoku" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">四国地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='shikoku' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" shikoku = ''">
                                    @foreach($Shikokuprefs as $pref)
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                    @endforeach
                                </div>
                            </li>

                            <li class="pointer-events-auto relative">
                                <button @click="kyusyu = ! kyusyu" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">九州・沖縄地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                <div x-show='kyusyu' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" kyusyu = ''">
                                    @foreach($Kyusyuprefs as $pref) 
                                        <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                            <input type="checkbox" name="searchpref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                        </label> 
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <span class="text-gray-800 text-sm">タグ : </span>
            @foreach($tags as $tag)     
                <label for="{{ $tag->tagname }}" class="cursor-pointer whitespace-nowrap">              
                    <input type="checkbox" name="searchtag[]" value="{{ $tag->id }}" id="{{ $tag->tagname }}" 
                    <?= in_array($tag->id,$searchtags,false) ? 'checked':'' ?> class="cursor-pointer w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <span id="{{ $tag->tagname }}" class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></span>
                    <span id="{{ $tag->tagname }}" class="text-gray-800 text-sm">{{ $tag->tagname }}</span>
                </label>
            @endforeach       
        </form>
    

    <!--memory-->
    @foreach($memories as $memory)
        <div class="md:mb-10 mb-5 border border-gray-500 bg-white border-2 md:rounded-lg rounded-xl">
            <div class="mx-5 md:mt-8 mt-6 mb-4">
                <div class="flex items-end border-b border-gray-200">
                    <p class="mr-2 w-4/5 font-bold text-[24px] text-gray-800 truncate">{{ $memory->title }}</p>
                    <a href="{{ route('ryojo.userpage',['userId' => $memory->user_id]) }}" class="block ml-auto w-1/5 text-right mt-2 text-gray-800 truncate">{{ $memory->user->name }}</a>
                </div>

                <div class="md:flex">    
                    <div class="md:w-3/5">
                            <img src="/src/image/日本地図.png" class="inline-block w-5 h-5 mr-1">  
                            @foreach($memory->prefectures as $prefecture)                         
                                <span class="mr-1 text-sm text-gray-600 whitespace-nowrap">{{ $prefecture->prefectures }}</span>
                            @endforeach

                        <div>    
                            <img src="/src/image/タグ.png" class="inline-block w-5 h-5 mr-1"> 
                            @foreach($memory->tags as $tag)
                                <span class="mt-2 mr-1 text-sm text-gray-600 whitespace-nowrap">{{ $tag->tagname }} </span>
                            @endforeach
                        </div>
                    
                        <div>
                            <p class="mx-2 mt-3 break-words text-gray-800 text-sm">{{ mb_substr($memory->content,0,75) }}...</p>  
                            <a href="{{ route('ryojo.memory',['memoryId' => $memory->id]) }}" class="mx-2 text-gray-800 text-[12px]">全文を表示</a><!--下からの距離に直す-->
                        </div>
                    </div>

                    <div class="md:w-2/5">
                        @foreach($memory->images as $image)
                            <img alt="{{ $image->name }}" class="object-contain m-auto md:mt-2 md:mr-4 w-[200px]" src="{{ image_url($image->name) }}"> 
                            @break
                        @endforeach
                    </div>
                </div> 

                <div class="flex justify-start">
                    <div x-data="ajax()">
                        @if(in_array($memory->id,$bookmarkMemoriesId,true))<!--お気に入りされている状態-->
                            <i class="fas fa-heart cursor-pointer text-red-500 ml-1" @click="createPost" id="{{ $memory->id }}"></i>
                            <span class="text-[14px] text-gray-600 mr-10">{{ $memory->bookmarks_count }}</span>
                        @else<!--お気に入りされていない状態-->
                            <i class="fas fa-heart cursor-pointer text-gray-600 ml-1" @click="createPost" id="{{ $memory->id }}"></i>
                            <span class="text-[14px] text-gray-600 mr-10">{{ $memory->bookmarks_count }}</span>
                        @endif
                    </div>

                    @if(\Illuminate\Support\Facades\Auth::id() === $memory->user_id)
                        <a class="flex mt-1 mr-12" href="{{ route('ryojo.update.textform',['memoryId' => $memory->id]) }}">
                            <i class="fa fa-edit text-gray-600"></i>
                            <span class="text-[14px] text-gray-600"></span>
                        </a>
                        <div x-data="{ open : false }">
                            <button @click="open = true" type="submit" class="text-[14px] text-gray-600"><i class="fa fa-trash text-gray-600"></i></button>
                                <!--delete確認モーダル-->
                                <div x-cloak x-show="open" class="z-30 fixed top-0 left-0 w-screen h-screen">
                                    <div class="top-o left-0 bg-black bg-opacity-80 w-screen h-screen">
                                        <div class="relative w-5/6 max-w-md h-1/3 m-auto bg-gray-100 border rounded-md shadow"
                                            style="top: 30vh; grid-template-rows: 4rem 1fr 6rem;">
                                            <p class="text-gray-800 text-center mt-16" >{{ $memory->title }}を削除します。<br>よろしいですか？</p>
                                            <form class="flex justify-center mt-8" action="{{ route('ryojo.delete',['memoryId' => $memory->id]) }}" method="post">
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
                    <div class="ml-auto text-gray-800 text-sm mr-4">{{ $memory->created_at }}</div>
                </div>   
            </div>                               
        </div>           
        @endforeach
    </div> 

    <!--人気の投稿-->
    <div class="invisible lg:visible absolute top-0 right-0 bg-gray-300 w-1/4 min-h-screen">
        <p class="text-center text-white bg-gray-400 px-5 py-1 rounded">人気の投稿</p>
        @foreach($popularMemories as $popularMemory)
        <div class="px-4 py-4 mx-4 my-4 rounded-lg bg-white">
            <a href="{{ route('ryojo.memory',['memoryId' => $popularMemory->id]) }}" class="block text-gray-800 hover:underline truncate whitespace-nowrap">{{ $popularMemory->title }}</a>
            <a href="{{ route('ryojo.userpage',['userId' => $popularMemory->user_id]) }}" class="block ml-auto text-right text-gray-800 text-[12px] hover:underline truncate whitespace-nowrap">{{ $popularMemory->user->name }}</a>
                @foreach($popularMemory->images as $image)
                    <img alt="{{ $image->name }}" class="object-contain m-auto md:mt-2 w-[160px]" src="{{ image_url($image->name) }}"> 
                    @break
                @endforeach        
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
window.addEventListener('pageshow',()=>{//ブラウザバックされたらリロード
	if(window.performance.navigation.type==2) location.reload();
});

function setPrefectures() {
    return {
          all : false,
          tohoku : false,
          kanto : false,
          chubu : false,
          kinki : false,
          chugoku :false,
          shikoku :false,
          kyusyu : false,
          prefectures : @json($searchprefs)
        }
    }

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
        })//Responseオブジェクトを結果にもつPromiseオブジェクトが返り値
        .then(response => {//Promiseオブジェクトのthenメソッド
            return response.json();//responseオブジェクトから、json()メソッドでjson本体の内容を抽出
        })
        .then(data => { //json()で解析した結果をdataとして受け取る
            e.target.classList.toggle('text-red-500');
            e.target.nextElementSibling.textContent = data.bookmarksCount;
        })
        .catch(error => {
            window.location.href = "{{ route('register.precheck') }}";
        });//戻り値はpromise,responseインターフェースのメソッド
     },       
    }
}//thenの代わりにasyncとawaitを使って記述することもできる
</script>
