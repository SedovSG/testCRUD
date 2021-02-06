{if $objects | length > 0}
	<h3 class="mb-4 text-center">{$header ? $header : ''}</h3>
	<table class="col-12 table table-bordered table-hover">
		<thead class="thead-dark mx-auto">
			<tr>
				<th scope="col">№</th>
				<th scope="col">ФИО</th>
				<th scope="col">Название</th>
				<th scope="col">Координаты</th>
				<th scope="col">Адрес</th>
				<th scope="col">Контрольные точки</th>
				<th scope="col">Редактировать</th>
			</tr>
		</thead>
		<tbody>

			{foreach $objects as $key => $val}
				<tr>
					<th scope="row">{$key + 1}</th>
					<td>{$val.lname} {$val.fname} {$val.mname}</td>
					<td>{$val.name}</td>
					<td>{$val.coordinates}</td>
			 		<td>{$val.address}</td>
			 		<td>{$val.points}</td>
			 		<td><a href="/index/edit/{$val.objects_id}">Редактировать</a></td>
				</tr>
			{/foreach}

		</tbody>
	</table>

{else}
	<h4 class="text-danger text-center mb-5">К сожалению ничего не удалось найти!</h4>
{/if}
