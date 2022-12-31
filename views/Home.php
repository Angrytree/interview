
<main class="px-3">
<table class="table interview-table">
  <thead class="table-light">
    <tr>
      <th>ID</th>
      <th>Question</th>
      <th>Status</th>
      <th>Date</th>
      <th><i class="bi bi-arrow-left-right"></i></th>
    </tr>
  </thead>
  <tbody>
    <tr class="add-tr">
      <td colspan="5">
          <form class="row g-4 row-nm" action="/interview/store" method="POST">
            <div class="col-6">
              <input type="text" class="form-control" placeholder="New question" name="question">
            </div>
            <div class="col-3">
              <select class="form-control" name="status_id" id="" title="Status">
                <?php foreach($statuses as $status):?>
                  <option value="<?=$status['id']?>"><?=$status['name']?></option>
                <?php endforeach?>
              </select>
            </div>
            <div class="col-2 text-start">
              <button type="submit" class="btn btn-primary add-answer"><i class="bi bi-plus"></i> Add</button>
            </div>
          </form>
			</td>
    </tr>
  <?php foreach($interviews as $interview):?>
    <tr>
      <td><?=$interview['id']?></td>
      <td><?=$interview['question']?></td>
      <td><?=$interview['status']?></td>
      <td><?=$interview['date']?></td>
      <td>
        <a href="/interview/show?id=<?=$interview['id']?>">
          <i class="bi bi-eye action a-edit" title="Show"></i>
        </a>
        <a href="/interview/delete?id=<?=$interview['id']?>">
          <i class="bi bi-trash2-fill action a-delete" title="Delete"></i>
        </a>
      </td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
</main>