@extends('pages.cpanel')

@section('content')
    {{-- @if (Auth::user()->role == 'Employee')   --}}
        <div class="todolist">
            <div class="todo">
                <div class="tdl">
                    <a href=""><ion-icon name="list-outline"></ion-icon></a>
                </div>
                <div class="teks">
                    Todo List !
                    <span>"Sometimes our stop-doing list needs to bigger than our to-do-list."</span>
                </div>
            </div>
        </div>
    {{-- @endif --}}
    <div class="details" style="grid:none !important;">
        <div class="recentOrders">
            <div class="cardHeader">
                @if (Auth::user() == 'Programmer')
                    <h2>Job Description</h2>
                @else
                    <h2>Project Progress</h2>
                @endif
            </div>
            <table id="example" class="display" style="width:100%">
                <thead> 
                    <tr>
                        @if (Auth::user()->role == 'Project Manager')
                            <th>Programmer</th>    
                        @endif
                        
                        <th>Task</th>
                        <th>Task Description</th>
                        <th>Actions</th>
                        <th>Status</th>
                    </tr>
                </thead>
                
                @foreach ($project as $client)
                <tr class=""> 
                    @if (Auth::user()->role == 'Project Manager')
                        <td> {{ $client->user->name }} </td>    
                    @endif
 
                    <td >{{ $client->client->details }}</td>
                    <td >{{ $client->taskdescription }}</td>
                    <td>
                        <form action="{{ route('admin.detailJob') }}" method="get" class="z-50">
                            @csrf
                            <input type="text" value="{{ $client->id }}" hidden name="idSend">
                            <button type="submit" class="w-16 block text-md text-blue-500 shadow bg-white active:scale-95 hover:text-black border-gray-200 px-3 py-1 rounded borde userView">
                                Detail
                            </button>
                        </form>
                    </td>
                    @php
                        $valueStat = $client->status;
                    @endphp
                    <td>
                        <form action="{{ '/admin/trigerStat' }}" method="post">
                            @csrf
                            <input type="text" name="trigerText" id="trigerText" value="{{ $client->client_id }}" hidden>
                            <button class="
                                @if ($valueStat == "Requested")
                                    statRequested
                                @elseif($valueStat == "On Progress")
                                    statProgres
                                @elseif ($valueStat == "Done")
                                    statDone                        
                                @elseif ($valueStat == "Rejected")
                                    statRejected    
                                @endif " 
                                type="submit"
                                style="cursor: pointer;"
                                @if($valueStat != 'On Progress' )
                                    disabled
                                @endif
                            >
                                {{ $client->status }}
                            </button>
                        </form>
                    </td>
                    {{-- <td class="@if($valueStat == 'On Progres') text-yellow-500 @elseif($valueStat == "Pending") text-gray-500 @elseif($valueStat == "Done") text-green-500 @elseif($valueStat == "Requested") text-blue-500 @elseif($valueStat == "Rejected") text-red-500 @elseif($valueStat == 'On Progress') text-yellow-500 @endif">
                        {{ $client->status }}
                    </td> --}}
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection