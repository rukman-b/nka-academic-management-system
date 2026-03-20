<form action="{{ route($route) }}" method="GET" class="form-inline" @if($tooltip) title="{{ $tooltip }}" @endif>
    <input type="hidden" name="filename" value="{{ $filename }}">

    <select name="format" class="form-control mr-2">
        <option value="xlsx" selected>XLSX</option>
        <option value="csv">CSV</option>
    </select>

    <button type="submit" class="btn btn-success btn-sm">
        <i class="fas fa-file-export"></i> {{ $label }}
    </button>
</form>