<template>
	<div>
		<table class="table table-report">
			<thead>
				<tr>
					<th class="whitespace-nowrap w-16">ID</th>
					<th class="whitespace-nowrap">Nazwa</th>
					<th class="whitespace-nowrap">Stan magazynowy</th>
					<th class="whitespace-nowrap w-32">Cena</th>
					<th class="whitespace-nowrap w-32">Status</th>
					<th class="whitespace-nowrap w-16">Działanie</th>
				</tr>
				<tr>
					<th><input type="text" /></th>
					<th><input type="text" /></th>
					<th><input type="text" /></th>
					<th><input type="text" /></th>
					<th><input type="text" /></th>
				</tr>
			</thead>
			<tbody>
				<tr class="intro-x" v-for="item in items" :key="item">
					<td class="w-16">1</td>
					<td>
						<div class="flex">
							<div class="w-10 h-10 image-fit mr-4">
								<img alt="test" class="rounded-full" src="/dist/images/preview-10.jpg" />
							</div>
							<div>
								<a href="font-medium whitespace-nowrap">Nazwa produktu</a>
								<div class="text-slate-500 flex items-center text-xs whitespace-nowrap mt-0.5">
									<ExternalLink :size="14" class="mr-2" />
									kategorie/anbc/123
								</div>
							</div>
						</div>
					</td>
					<td>Status</td>
					<td class="w-32">
						<div class="flex text-green-600 items-center">
							<Check class="mr-2" :size="14" />
							<span>Aktywny</span>
						</div>
					</td>
					<td class="w-32">Status</td>
					<td class="w-16 text-right">
						<div class="dropdown">
							<button class="dropdown-toggle btn btn-default btn-action text-slate-300 hover:text-slate-500" aria-expanded="false" data-tw-toggle="dropdown">
								<Settings />
							</button>
							<div class="dropdown-menu w-40">
								<ul class="dropdown-content">
									<li> <a href="" class="dropdown-item"><Edit2 class="w-4 h-4 mr-2" /> Edytuj</a> </li>
									<li> <a href="" class="dropdown-item"><Copy class="w-4 h-4 mr-2" /> Duplikuj</a> </li>
									<li> <hr class="dropdown-divider"> </li>
									<li> <a href="" class="dropdown-item text-red-600"><Trash class="w-4 h-4 mr-2" /> Usuń</a> </li>
								</ul>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
import { ExternalLink, Check, X, Settings, Edit2, Trash, Copy } from 'lucide-vue';

export default {
	components: {
		ExternalLink,
		Check,
		X,
		Settings,
		Edit2,
		Trash,
		Copy
	},
	data() {
		return {
			items: 10
		}
	}
}
</script>
