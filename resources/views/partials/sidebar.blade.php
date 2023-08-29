<div class="sidebar">
    <div class="sidebar-container">
        <a href="{{ route('home') }}" class="sidebar-link"><span class="material-icons sidebar-icon">home</span>
            <p class="sidebar-text">Home</p>
        </a>
        <a href="{{ route('tasks.index') }}" class="sidebar-link"><span class="material-icons sidebar-icon">list</span>
            <p class="sidebar-text">Task List</p>
        </a>
        <a class="sidebar-link" href="{{ route('tasks.progress') }}">
            <span class="material-icons sidebar-icon">check_box</span>
            <p class="sidebar-text">Task Progress</p>
          </a>
    </div>
</div>
