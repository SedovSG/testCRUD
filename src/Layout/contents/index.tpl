<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
			{include "components/object/table.tpl" header="Список всех объектов"}

			<div class="col-8 mx-auto col-sm-6">

				<h3 class="text-center mb-5 mt-5">Уточнить объекты</h3>

				{include "components/object/form.tpl" action="/index/search" button_text="Найти"}

				<div class="text-center mt-3"><a href="/index/add">Добавить объект</a></div>
			</div>

		</div>
	</div>
</div>