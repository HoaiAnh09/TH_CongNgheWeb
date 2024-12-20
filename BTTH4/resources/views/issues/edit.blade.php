<!-- resources/views/issue/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sửa Vấn Đề</h1>
        
        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="computer_id" class="form-label">Máy Tính</label>
                <select name="computer_id" id="computer_id" class="form-select" required>
                    <option value="">Chọn máy tính</option>
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>
                            {{ $computer->computer_name }} - {{ $computer->model }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="reported_by" class="form-label">Người Báo Cáo</label>
                <input type="text" class="form-control" id="reported_by" name="reported_by" value="{{ old('reported_by', $issue->reported_by) }}" required>
            </div>

            <div class="mb-3">
                <label for="reported_date" class="form-label">Thời Gian Báo Cáo</label>
                <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" value="{{ old('reported_date', $issue->reported_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô Tả Sự Cố</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $issue->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="urgency" class="form-label">Mức Độ Sự Cố</label>
                <select name="urgency" id="urgency" class="form-select" required>
                    <option value="Low" {{ old('urgency', $issue->urgency) == 'Low' ? 'selected' : '' }}>Thấp</option>
                    <option value="Medium" {{ old('urgency', $issue->urgency) == 'Medium' ? 'selected' : '' }}>Trung Bình</option>
                    <option value="High" {{ old('urgency', $issue->urgency) == 'High' ? 'selected' : '' }}>Cao</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng Thái</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Open" {{ old('status', $issue->status) == 'Open' ? 'selected' : '' }}>Mở</option>
                    <option value="In Progress" {{ old('status', $issue->status) == 'In Progress' ? 'selected' : '' }}>Đang Xử Lý</option>
                    <option value="Resolved" {{ old('status', $issue->status) == 'Resolved' ? 'selected' : '' }}>Đã Giải Quyết</option>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Cập Nhật</button>
        </form>
    </div>
@endsection
