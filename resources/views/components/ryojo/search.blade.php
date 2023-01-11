<form method="GET" action="{{ route('ryojo.index') }}">
    <input type="search" placeholder="" name="search" value="@if (isset($search)) {{ $search }} @endif"><!--$searchがnullならfalse-->
    <div>
        <button type="submit">検索</button>
        <button>
            <a href="{{ route('ryojo.index') }}" class="text-white">
                クリア
            </a>
        </button>
    </div>
</form>

@foreach($users as $user)
    <a href="{{ route('users.show', ['user_id' => $user->id]) }}">
        {{ $user->name }}
    </a>
@endforeach


<div>
 <!--下記のようにページネーターを記述するとページネートで次ページに遷移しても、検索結果を保持する-->
    {{ $institutions->appends(request()->input())->links() }}
</div>