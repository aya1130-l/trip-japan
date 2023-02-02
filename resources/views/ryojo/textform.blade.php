<x-layoutgray title="旅情 -日本旅行記投稿フォーム-">
    <p class="text-center mt-24  text-lg text-gray-800">< 旅行記投稿フォーム ></p>
    <div class="w-11/12 md:w-[650px] min-h-[600px] m-auto mt-4 border-4 border-gray-400 bg-white rounded-lg">
        <div class="m-auto mt-4 w-5/6">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <form action="{{ route('ryojo.imgform') }}" method="post" enctype="multipart/form-data"> 
                @csrf
                @if(old('title') or old('content'))
                    <div class="m-auto mt-8 w-5/6">
                        <p class="text-gray-800">title:</p>
                        <textarea type="text" name="title" placeholder="旅行記に題名をつけましょう" class="block border-2 border-gray-300 w-full rounded resize-none h-12">{{ old('title') }}</textarea>
                    </div>
                    <div class="m-auto mt-8 w-5/6">
                        <p class="text-gray-800">content:</p>
                        <textarea name="content" placeholder="旅の思い出を綴りましょう" class="block border-2 border-gray-300 w-full h-40 rounded resize-none">{{ old('content') }}</textarea>
                    </div>
                @else
                    <div class="m-auto mt-8 w-5/6">
                        <p class="text-gray-800">title:</p>
                        <textarea type="text" name="title" placeholder="旅行記に題名をつけましょう" class="block border-2 border-gray-300 w-full rounded resize-none h-12">{{ $title }}</textarea>
                    </div>
                    <div class="m-auto mt-8 w-5/6">
                        <p class="text-gray-800">content:</p>
                        <textarea name="content" placeholder="旅の思い出を綴りましょう" class="block border-2 border-gray-300 w-full h-40 rounded resize-none">{{ $content }}</textarea>
                    </div> 
                @endif
                
                <div class="m-auto w-5/6 mt-8 z-10">
                @if(old('pref'))
                    <div x-data="setVaPrefectures()"> <!--validation-->
                @elseif(empty($selectedprefsName))
                    <div x-data="setPrefectures()"> <!--デフォ-->
                @else
                    <div x-data="setRePrefectures()"> <!--修正(revise)-->
                @endif
                        <p class="text-gray-800">location:</p>
                        <a tabindex="0" @click="all = ! all" class="relative text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center pointer-events-auto cursor-pointer">都道府県を選択<svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></a>
                        <a @click="prefectures = []" class="text-sm text-gray-800 underline cursor-pointer md:ml-2 whitespace-nowrap">選択を解除</a>
                        <span class="text-gray-800 text-sm" id="checkedprefectures" x-text="prefectures"></span>
                        <div x-show="all" x-cloak>
                            <div class="bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                    <li class="pointer-events-auto relative">
                                        <button @click="tohoku = ! tohoku" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">北海道・東北地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                        <div x-show='tohoku' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" tohoku = ''">
                                        @foreach($Tohokuprefs as $pref)
                                            <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                                <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <span class="text-gray-800 whitespace-nowrap">{{ $pref->prefectures }}</span>    
                                                </label> 
                                        @endforeach
                                        </div>
                                    </li>

                                    <li class="pointer-events-auto relative">
                                        <button @click="chubu = ! chubu" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">中部地方<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>                  
                                        <div x-show='chubu' class="absolute z-10 bg-white rounded shadow dark:bg-gray-700" @click.away=" chubu = ''">
                                            @foreach($Chubuprefs as $pref)
                                                <label for="{{ $pref->prefectures }}" class="cursor-pointer whitespace-nowrap">
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                                    <input type="checkbox" name="pref[]" value="{{ $pref->prefectures }}" id="{{ $pref->prefectures }}" x-model="prefectures" class="cursor-pointer leading-7 w-5 h-5 ml-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <span class="text-gray-800">{{ $pref->prefectures }}</span>    
                                                </label> 
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-auto my-8 w-5/6">
                    <p class="text-gray-800">tag:</p>
                    @foreach($tags as $tag)
                        @if(old('tag'))
                            <label for="{{ $tag->tagname }}" class="mr-2 cursor-pointer whitespace-nowrap">
                                <input type="checkbox" name="tag[]" value="{{ $tag->id }}" 
                                <?= in_array($tag->id,old('tag'),false) ? 'checked' : '' ?> id="{{ $tag->tagname }}" class="cursor-pointer w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></span>
                                <span class="text-gray-800 text-sm">{{ $tag->tagname }}</span>
                            </label>
                        @elseif(isset($selectedtagsId))
                            <label for="{{ $tag->tagname }}" class="mr-2 cursor-pointer whitespace-nowrap">
                                <input type="checkbox" name="tag[]" value="{{ $tag->id }}" id="{{ $tag->tagname }}"
                                <?= in_array($tag->id,$selectedtagsId,false) ? 'checked':'' ?> class="cursor-pointer w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></span>
                                <span class="text-gray-800 text-sm">{{ $tag->tagname }}</span>
                            </label>
                        @else
                            <label for="{{ $tag->tagname }}" class="mr-2 cursor-pointer whitespace-nowrap">
                                <input type="checkbox" name="tag[]" value="{{ $tag->id }}" id="{{ $tag->tagname }}"
                                class="cursor-pointer w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span id="{{ $tag->tagname }}" class="w-4 h-4 text-teal-600 bg-gray-100 rounded border-gray-300 focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"></span>
                                <span id="{{ $tag->tagname }}" class="text-gray-800 text-sm">{{ $tag->tagname }}</span>
                            </label>
                        @endif
                    @endforeach
                </div>
    </div>

    <button type="submit" class="block md:w-2/5 w-[200px] h-12 mx-auto mt-20 mb-8 bg-[#001a1a] hover:bg-[#1e3333] text-white rounded-lg">次へ(画像選択)</button>        
    <a href="{{ route('ryojo.index') }}" class="block md:w-2/5 w-[200px] h-12 mx-auto mb-20 py-3 bg-[#b3a7a1] hover:bg-[#ccc1b8] text-center text-white rounded-lg">TOPに戻る</a>        
</x-layoutgray>  


<script>
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
          prefectures : [] 
        }
    }

function setRePrefectures() {
    return {
          all : false,
          tohoku : false,
          kanto : false,
          chubu : false,
          kinki : false,
          chugoku :false,
          shikoku :false,
          kyusyu : false,
          prefectures : @json($selectedprefsName)
        }
    }

function setVaPrefectures() {
    return {
          all : false,
          tohoku : false,
          kanto : false,
          chubu : false,
          kinki : false,
          chugoku :false,
          shikoku :false,
          kyusyu : false,
          prefectures : @json(old('pref')),
        }
}
</script>








