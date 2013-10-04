    function Course(data)
    {
        this.id         = ko.observable(data.id);
        this.fullname   = ko.observable(data.fullname);
        this.shortname  = ko.observable(data.shortname);
    }

    function Group(data)
    {
        this.id         = ko.observable(data.id);
        this.name       = ko.observable(data.name);
    }

    function Teacher(data)
    {
        this.id        = ko.observable(data.id);
        this.username  = ko.observable(data.username);
        this.firstname = ko.observable(data.firstname);
        this.lastname  = ko.observable(data.lastname);
    }

    function Student(data)
    {
        this.id         = ko.observable(data.id);
        this.Email      = ko.observable(data.Email);
        this.Firstname  = ko.observable(data.Firstname);
        this.Lastname   = ko.observable(data.Lastname);
        this.ROLE       = ko.observable(data.ROLE);
        this.RoleName   = ko.observable(data.RoleName);
        this.Username   = ko.observable(data.Usernamse);
        this.actividad  = ko.observable(data.actividad);
        this.grupo      = ko.observable(data.grupo);
        this.status     = ko.observable(data.status);
        this.grade      = ko.observable(Math.ceil(data.grade * 10) / 10);
    }

    function ReportViewModel()
    {
        var self      = this;
        self.courses  = ko.observableArray([]);
        self.groups   = ko.observableArray([]);
        self.students = ko.observableArray([]);
        self.teachers = ko.observableArray([]);

        self.getExcel = function()
        {
            var courseid    = $('#courseid').val();
            var plantel     = $('#plantel').val();
            var groupid     = $('#groupid').val();
            //var planteltxt  = $('#plantel_txt').text();
            var cursotxt    = $('#asignatura_txt').text();
            var grupotxt    = $('#grupo_txt').text();;

            window.open('excelh.php?courseid='+courseid+'&plantel='+plantel+'&groupid='+groupid+'&cursotxt='+cursotxt+'&grupotxt='+ grupotxt);
            //e.preventDefault();
        }

        self.updateResume = function()
        {          
            var  courseid = $('#courseid').val();
            var  plantel  = $('#plantel').val();
            var  groupid  = $('#groupid').val();  

            if(groupid == null || groupid == 0)
            {
                return;
            }

            var plantel_display = (plantel > 0) ? $('#plantel').find(":selected").text() : 'Todos' ;
            //$('#plantel_txt').text(plantel_display);

            var curso_display = (courseid > 0) ? $('#courseid').find(":selected").text() : 'Todos' ;
            $('#asignatura_txt').text(curso_display);     

            var grupo_display = (groupid > 0) ? $('#groupid').find(":selected").text() : 'Todos' ;
            $('#grupo_txt').text(grupo_display);       

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = dd+'/'+mm+'/'+yyyy;
            $('#fecha_txt').text(today);            

            self.getTeacher()
            $('#resume').show();    
        }

        self.getTeacher = function()
        {
            self.teachers.removeAll();

            var  courseid = $('#courseid').val();
            var  plantel  = $('#plantel').val();
            var  groupid  = $('#groupid').val();           
            if(courseid > 0 && groupid > 0)
            {
                $.getJSON('report.php?action=teacher&courseid='+courseid+'&groupid=' + groupid, function(data)
                {
                    var mappedTeachers = $.map(data, function(teacher) { return new Teacher(teacher)});
                    if(mappedTeachers.length > 0)
                    {     
                        $.each(mappedTeachers, function(key, value)
                        {
                            self.teachers.push(value);
                        });
                    }                    
                });
            }             
        }        
 
        self.getRows = function()
        {
            self.students.removeAll();
            $('#resume').hide();

            var  courseid = $('#courseid').val();
            var  plantel  = $('#plantel').val();
            var  groupid  = $('#groupid').val();

            $.getJSON('report.php?action=report&courseid='+courseid+'&plantel='+plantel+'&groupid=' + groupid, function(data)
            {
                var mappedStudents = $.map(data, function(student) { return new Student(student)});
                if(mappedStudents.length > 0)
                {     
                    $.each(mappedStudents, function(key, value)
                    {
                        self.students.push(value);
                    });

                    self.updateResume();                                    
                }                
            })
        }

        self.getGroups = function()
        {
            self.groups.removeAll();
            
            $.getJSON('report.php?action=groups&courseid=' + $('#courseid').val() + '&plantel='+$('#plantel').val(), function(data)
            {
                var mappedGroups = $.map(data, function(group) { return new Group(group)});
                if(mappedGroups.length > 0)
                {     
                    var blank = new Group({id:0, name: '- Seleccione -'});
                    self.groups.push(blank);

                    $.each(mappedGroups, function(key, value)
                    {
                        self.groups.push(value);
                    });                 
                }               
            })
        }        

        self.getCourses = function()
        {
            $.getJSON('report.php?action=courses', function(data)
            {
                var mappedCourses = $.map(data, function(course) { return new Course(course)});
                if(mappedCourses.length > 0)
                {     
                    var blank = new Course({id:0, fullname: 0, shortname: '-Seleccione-'});
                    self.courses.push(blank);

                    $.each(mappedCourses, function(key, value)
                    {
                        self.courses.push(value);
                    });                 
                }               
            })
        }

        self.getCourses();              
    }

    ko.applyBindings(new ReportViewModel())