<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Setting;

    use App\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Http\Requests\Setting\Domain\StoreRequest;
	use Multimedia\Multistore\Core\Http\Requests\Setting\Domain\RestoreRequest;
	use Multimedia\Multistore\Core\Models\OptionDomain;

    class DomainController extends Controller
    {
        public function index() {
			set_title(__('backend::setting.Domains'));
			add_action_header(__('backend::setting.Add domain'), route('backend.setting.domain.create'));

			create_table('domains', [
				'query' => OptionDomain::paginate(30),
				'headers' => [
					['header' => 'Adres www', 'id' => 'domain'],
					['header' => 'SSL', 'id' => 'ssl', 'type' => 'boolean', 'headerClass' => 'w-32', 'bodyClass' => 'text-center']
				],
				'actions' => [
					['id' => 'edit', 'name' => 'Edycja', 'route' => route('backend.setting.domain.update', ['optionDomain' => '$hash'])],
					['id' => 'delete', 'name' => 'Usuń', 'route' => route('backend.setting.domain.delete', ['optionDomain' => '$hash']), 'options' => ['method' => 'delete']]
				]
			]);

			return view('backend::setting.domain.index');
        }

		public function create() {
			set_meta_title(__('backend::setting.Add domain'));
			return view('backend::setting.domain.form');
		}

		public function store(StoreRequest $request) {
			$options = $request->except(['ssl', '_token', 'domain']);

			OptionDomain::create([
				'domain' => $request->domain,
				'ssl' => $request->ssl ? true : false,
				'options' => $options
			]);

			return redirect()->route('backend.setting.domain')->with('success', 'Domena została dodana');
		}

		public function update(OptionDomain $optionDomain) {
			set_meta_title(__('backend::setting.Add domain'));
			return view('backend::setting.domain.form', ['item' => $optionDomain]);
		}

		public function restore(RestoreRequest $request, OptionDomain $optionDomain) {
			$options = $request->except(['ssl', '_token', 'domain']);

			$optionDomain->update([
				'domain' => $request->domain,
				'ssl' => $request->ssl ? true : false,
				'options' => $options
			]);

			return redirect()->route('backend.setting.domain')->with('success', 'Domena została zmodyfikowana');
		}

		public function delete(OptionDomain $optionDomain) {
			$optionDomain->delete();
			return redirect()->route('backend.setting.domain')->with('success', 'Domena została usunięta');
		}
    }
