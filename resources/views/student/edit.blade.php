<form action="{{route('student.update', $student->id)}}" method="post" align="center">
    
    @csrf
    @method('PUT')
    <h2>Edit Student</h2>
    
    <input type="text" name="name" value="{{$student->name}}">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>
    
    <input type="text" name="email" value="{{$student->email}}">
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>
    
    <input type="text" name="phone" value="{{$student->phone}}">
    @error('phone')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>
    
    <input type="text" name="city" value="{{$student->city}}">
    @error('city')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>
    
    <input type="text" name="inrollment_no" value="{{$student->inrollment_no}}">
    @error('inrollment_no')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>

    {{-- Fixed: added course field so it can be updated --}}
    <select name="course" id="course">
        <option value="">Select Course</option>
        @foreach(['Maths', 'Physics', 'Laravel', 'MBA', 'MCA', 'BCA'] as $option)
            <option value="{{ $option }}" {{ $student->course?->course_name === $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    @error('course')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    <br>
    
    <button type="submit">Update</button>
</form>
<a href="{{route('student.show')}}">Back</a>