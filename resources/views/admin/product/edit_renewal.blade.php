<label for="exampleInputEmail1">Renewal</label>
<select name="renewal_type" id="" class="form-control">
    <option value="">{{ $product->renewal_type }}</option>
    @if($product->renewal_type == "monthly")
    <option value="annually">Annually</option>
    @else
    <option value="monthly">Monthly</option>
    @endif
</select>