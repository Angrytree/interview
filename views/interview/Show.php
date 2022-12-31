<main class="px-3">
<table class="table interview-table">
  <thead class="table-light">
    <tr>
      <th>Question</th>
      <th>Status</th>
      <th>Date</th>
      <th><i class="bi bi-arrow-left-right"></i></th>
    </tr>
  </thead>
  <tbody>
    <tr class="text-start">
      <td><?=$interview['question']?></td>
      <td><?=$interview['status']?></td>
      <td><?=$interview['date']?></td>
      <td>
        <a class="showEditBlock" data-id="iv<?=$interview['id']?>">
          <i class="bi bi-pen action a-edit" title="Edit"></i>
        </a>
      </td>
    </tr>
    <tr class="d-none edit-tr" id="editBlockiv<?=$interview['id']?>">
      <td colspan="4">
				<form class="row g-4 row-nm" action="/interview/edit" method="POST">
          <input type="hidden" name="id" value="<?=$interview['id']?>">
					<div class="col-6">
						<input type="text" class="form-control" placeholder="Question" name="question" value="<?=$interview['question']?>">
					</div>
					<div class="col-3">
            <select class="form-control" name="status_id" id="" title="Status">
              <?php foreach($statuses as $status):?>
                <option value="<?=$status['id']?>" <?=$status['id'] == $interview['status_id'] ? 'selected' : ''?>><?=$status['name']?></option>
              <?php endforeach?>
            </select>
					</div>
					<div class="col-2 text-start">
						<button type="submit" class="btn btn-warning add-answer">Edit</button>
					</div>
				</form>
			</td>
    </tr>
  </tbody>
  <thead class="table-light">
    <tr>
      <th colspan="2">Answer</th>
      <th>Count</th>
      <th><i class="bi bi-arrow-left-right"></i></th>
    </tr>
  </thead>
  <tbody>
    <tr class="add-tr">
			<td colspan="4">
				<form class="row g-4 row-nm" action="/interview/answer/add" method="POST">
					<div class="col-6">
						<input type="text" class="form-control" placeholder="New answer">
					</div>
					<div class="col-3">
						<input type="number" class="form-control" placeholder="0">
					</div>
					<div class="col-2 text-start">
						<button type="submit" class="btn btn-primary add-answer"><i class="bi bi-plus"></i> Add</button>
					</div>
				</form>
			</td>
    </tr>
    <?php foreach($interview['answers'] as $answer):?>
    <tr class="text-start">
      <td colspan="2"><?=$answer['text']?></td>
      <td><?=$answer['count']?></td>
      <td>
        <a class="showEditBlock" data-id="ans<?=$answer['id']?>">
          <i class="bi bi-pen action a-edit" title="Edit"></i>
        </a>
        <a href="/answer/delete?id=<?=$answer['id']?>">
          <i class="bi bi-trash2-fill action a-delete" title="Delete"></i>
        </a>
      </td>
    </tr>
    <tr class="d-none edit-tr" id="editBlockans<?=$answer['id']?>">
      <td colspan="4">hello ans</td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
</main>
<script src="/js/interview.js"></script>