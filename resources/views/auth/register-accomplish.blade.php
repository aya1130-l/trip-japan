<x-guest-layout>
    <x-auth-card>

    
       <p class="text-gray-800 text-center mt-4">登録が完了しました！</br>
            素敵な投稿をお待ちしております : )</p>
        
     
        <div class="flex justify-center my-6">
            <a href="{{ route('ryojo.index') }}" class="block w-1/3 min-w-[120px] px-2 py-2 mx-4 bg-gray-800 hover:bg-gray-600 text-sm text-center text-white font-bold rounded-lg whitespace-nowrap truncate"> 旅行記を見る</a>
            <a href="{{ route('ryojo.form') }}" class="block w-1/3 min-w-[120px] px-2 py-2 mx-4 bg-gray-800 hover:bg-gray-600 text-sm text-center text-white font-bold rounded-lg whitespace-nowrap truncate">投稿する</a>
        </div>   
    </x-auth-card>
</x-guest-layout>