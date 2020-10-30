
<button> <a id="btnExport" onclick="exportF(this)" class="btn btn-success btn-fill" style='margin-bottom:5px;'>Export to Excel</a></button><br>

<table id="renz" class="table table-striped table-bordered" style="width:100%;" border='1'>
    <thead>
        <th>Encoded By</th>
        <th>laborer Name</th>
        <th>Company</th>
        <th>Department</th>
        <th>Work</th>
        <th>Schedule Start</th>
        <th>Schedule End</th>
        <th> Manhours (HOURS)</th>
        <th>Breaktime</th>
    </thead>
    <tbody>
        
        @foreach($schedules as $schedule)
        <tr>
            <td>{{$schedule->user_info->name}}
            </td>
            <td>{{$schedule->laborer_name}}</td>
            <td>{{$schedule->company_name}}</td>
            <td>{{$schedule->department_name}}</td>
            <td>{{$schedule->work_name}}</td>
            <td>{{$schedule->date.' '.$schedule->start_time}}</td>
            <td>{{$schedule->end_date.' '.$schedule->end_time}}</td>

            @php
            $date_start = $schedule->date.' '. date("H:i", strtotime($schedule->start_time));
            $date_end = $schedule->end_date.' '. date("H:i", strtotime($schedule->end_time));
            $time_Rendered =(strtotime($date_end)-strtotime($date_start))/3600;
            @endphp
            <td> {{ $time_Rendered }}</td>
            <td>@if($schedule->with_breaktime == null) 0 @else 1 @endif</td>
            
        </tr>
        @endforeach
    </tbody>
</table>
{{$schedules->links()}}

<script>
    function exportF(elem) {
        // var period =  document.getElementById('period').innerHTML;  
        var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
            var textRange; var j = 0;
            tab = document.getElementById('renz');//.getElementsByTagName('table'); // id of table
            if (tab==null) {
                return false;
            }
            if (tab.rows.length == 0) {
                return false;
            }
            
            for (j = 0 ; j < tab.rows.length ; j++) {
                tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                //tab_text=tab_text+"</tr>";
            }
            
            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
            tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
            tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
            
            var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
            {
                txtArea1.document.open("txt/html", "replace");
                txtArea1.document.write(tab_text);
                txtArea1.document.close();
                txtArea1.focus();
                sa = txtArea1.document.execCommand("SaveAs", true, "schedules.xls");
            }
            else                 //other browser not tested on IE 11
            //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download =  'schedules';
                }
                
                a.href = link;
                
                document.body.appendChild(a);
                
                a.click();
                
                document.body.removeChild(a);
            } catch (e) {
            }
            
            
            return false;
            //return (sa);
        }
    </script>