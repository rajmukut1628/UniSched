@php
    $navigationGroups = [
        'Overview' => [
            ['admin.dashboard', 'Dashboard'],
        ],
        'Academic Management' => [
            ['admin.semesters.index', 'Semesters'],
            ['admin.sections.index', 'Sections'],
            ['admin.courses.index', 'Courses'],
            ['admin.teachers.index', 'Faculty'],
            ['admin.teacher-availability.index', 'Faculty Availability'],
        ],
        'Scheduling' => [
            ['admin.time-slots.index', 'Time Slots'],
            ['admin.rooms.index', 'Rooms & Labs'],
            ['admin.course-assignments.index', 'Course Assignments'],
            ['admin.routines.index', 'Routine Builder'],
            ['admin.routine-views.index', 'Routine Views'],
            ['admin.routine-publish.index', 'Publish Routine'],
        ],
        'System' => [
            ['admin.admins.index', 'Admin Management'],
        ],
    ];
@endphp

@foreach($navigationGroups as $group => $links)
    <div class="unisched-nav-group">{{ $group }}</div>
    @foreach($links as [$routeName, $label])
        <a href="{{ route($routeName) }}"
           class="unisched-nav-link{{ request()->routeIs($routeName) ? ' active' : '' }}"
           @if(request()->routeIs($routeName)) aria-current="page" @endif>
            {{ $label }}
        </a>
    @endforeach
@endforeach
