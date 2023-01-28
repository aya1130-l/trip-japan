<x-layout title="TOP|旅情　-美しい日本を投稿しよう- 国内旅行情報投稿サイト"> 
    
    <div class="100vl">
        <div class="min-h-screen bg-ryojo-home2 bg-no-repeat bg-center bg-cover bg-blend-soft-light bg-black bg-opacity-50">  
            <h1 class="pt-40 pb-4 text-center text-[48px] text-white font-sans">旅 情</h1>
            <p class="pb-4 text-white text-center">ー japan journey ー</p>    
            <hr class="mx-auto w-3/5"></hr>
                <p class="my-12 text-white text-center text-[18px]">あなたの日本旅を投稿しよう</p>
                <div class="md:flex md:justify-center text-center">
                    <button type="button" onclick="location.href='{{ route('ryojo.form') }}'" class="block md:mx-8 mx-auto mb-6 px-4 py-2 w-56 bg-white bg-opacity-25 rounded-sm text-white hover:bg-opacity-50">投稿する(新規登録)</button>
                    <button type="button" onclick="location.href='{{ route('ryojo.index') }}'" class="block md:mx-8 mx-auto mb-6 px-4 py-2 w-56 bg-white bg-opacity-25 rounded-sm text-white hover:bg-opacity-50">皆の旅行記を見る</button>
                </div>
                <form action="{{ route('guestlogin') }}" method="post">
                    @csrf
                    <button type="submit" class="block md:text-center md:mt-12 mx-auto px-4 py-2 w-56 bg-white bg-opacity-25 rounded-sm text-white hover:bg-opacity-50">ゲストログイン</button>
                </form>
            </div>
        </div>

</x-layout>

