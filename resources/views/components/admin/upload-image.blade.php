@props(['key'])
{{-- Upload Image Button --}}
<div class="btn_upload trip">
    <input class="image_upload" type="file" name="image{{$key}}">
    Upload Image
</div>
{{-- Upload Image View --}}
<div class="uploaded_image_view trip">
    <span class="image_remove">X</span>
    <img class="object-fit-cover preview" style="width: 250px; height: 250px;" src="#">
</div>