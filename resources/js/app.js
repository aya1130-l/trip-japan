//app.jsがwebpack.mix.jsで指定したコンパイル対象のファイル
//ほかのjsファイルをここで読み込んでおく
//あるいはwebpackmixで全部コンパイル対象のファイルとして指定してもいい
//今回は前者の方法なのでimportで色々読み込んでる

import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();








