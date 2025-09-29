<p>Dear stakeholder,</p>
<p>A new bill has been created:</p>
<ul>
  <li>Flat: {{ $bill->flat->flat_number }} (Building: {{ $bill->building->name }})</li>
  <li>Category: {{ $bill->category->name }}</li>
  <li>Month: {{ $bill->month->format('F Y') }}</li>
  <li>Amount: {{ number_format($bill->amount,2) }}</li>
  <li>Due Previous: {{ number_format($bill->due_previous,2) }}</li>
</ul>
<p>Notes: {{ $bill->notes }}</p>
