<?php

	namespace Multimedia\Multistore\Core\Http\Components;

	use Illuminate\View\Component;

	class Meta extends Component {
        public $robots = [];
		public $item = [];

        public function __construct($item = [])
        {
            $this->robots = [
                ['id' => 'all', 'name' => '<b>all</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Brak ograniczeń indeksowania i wyświetlania.</span>'],
                ['id' => 'noindex', 'name' => '<b>noindex</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia wyświetlanie strony, treści multimedialnej lub zasobu w wynikach wyszukiwania.</span>'],
                ['id' => 'nofollow', 'name' => '<b>nofollow</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Nie korzystaj z linków na tej stronie. </span>'],
                ['id' => 'none', 'name' => '<b>none</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Odpowiednik: noindex, nofollow.</span>'],
                ['id' => 'noarchive', 'name' => '<b>noarchive</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia wyświetlanie w wynikach wyszukiwania linku z pamięci podręcznej.</span>'],
                ['id' => 'nositelinkssearchbox', 'name' => '<b>nositelinkssearchbox</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia wyświetlanie pola wyszukiwania z linkami do podstron w wynikach wyszukiwania dotyczących tej strony.</span>'],
                ['id' => 'nosnippet', 'name' => '<b>nosnippet</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia wyświetlanie w wynikach wyszukiwania krótkiego fragmentu strony lub podglądu filmu.</span>'],
                ['id' => 'indexifembedded', 'name' => '<b>indexifembedded</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Google może indeksować treść strony umieszczonej na innej stronie za pomocą elementów iframes lub podobnych tagów HTML pomimo zastosowania reguły noindex.</span>'],
                ['id' => 'notranslate', 'name' => '<b>notranslate</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia proponowanie tłumaczenia danej strony w wynikach wyszukiwania. </span>'],
                ['id' => 'noimageindex', 'name' => '<b>noimageindex</b> <br /> <span class=\'leading-relaxed text-slate-500 text-xs\'>Uniemożliwia indeksowanie obrazów na tej stronie.</span>'],
            ];

			$this->item = $item;
        }

		public function render() {
			return view('backend::components.meta');
		}
	}

?>
