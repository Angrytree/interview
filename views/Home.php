
<main class="px-3">
<table class="table interview-table">
  <thead class="table-light">
    <tr class="text-start">
      <th><a class="order-link" href="/home?order=id&order_type=<?=$order =='id' ? ($orderType == 'asc' ? 'desc' : 'asc') : 'asc' ;?>">ID</a></th>
      <th><a class="order-link" href="/home?order=question&order_type=<?=$order =='question' ? ($orderType == 'asc' ? 'desc' : 'asc') : 'asc' ;?>">Question</a></th>
      <th><a class="order-link" href="/home?order=status&order_type=<?=$order =='status' ? ($orderType == 'asc' ? 'desc' : 'asc') : 'asc' ;?>">Status</a></th>
      <th><a class="order-link" href="/home?order=date&order_type=<?=$order =='date' ? ($orderType == 'asc' ? 'desc' : 'asc') : 'asc' ;?>">Date</a></th>
      <th><i class="bi bi-arrow-left-right"></i></th>
    </tr>
  </thead>
  <tbody>
    <tr class="add-tr">
      <form hidden class="row g-4 row-nm" action="/interview/store" method="POST" id="addInterviewForm"></form>
      <td colspan="2">
        <input type="text" class="form-control" placeholder="New question" name="question" form="addInterviewForm">
      </td>
      <td colspan="2">
        <select class="form-control" name="status_id" id="" title="Status" form="addInterviewForm">
          <?php foreach($statuses as $status):?>
            <option value="<?=$status['id']?>"><?=$status['name']?></option>
          <?php endforeach?>
        </select>
      </td>
      <td class="text-start">
        <button type="submit" class="btn btn-primary add-answer" form="addInterviewForm"><i class="bi bi-plus"></i> Add</button>
      </td>
    </tr>
  <?php foreach($interviews as $interview):?>
    <tr class="text-start">
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