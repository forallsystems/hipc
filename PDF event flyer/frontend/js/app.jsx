var React = require('react');
var ReactDOM = require('react-dom');
var Select = require('react-select');

var GRADE_LEVEL_OPTIONS = [
    { value: 'K', label: "Kindergarten"},
    { value: 1, label: "1st Grade"},
    { value: 2, label: "2nd Grade"},
    { value: 3, label: "3rd Grade"},
    { value: 4, label: "4th Grade"},
    { value: 5, label: "5th Grade"},
    { value: 6, label: "6th Grade"},
    { value: 7, label: "7th Grade"},
    { value: 8, label: "8th Grade"},
    { value: 9, label: "9th Grade"},
    { value: 10, label: "10th Grade"},
    { value: 11, label: "11th Grade"},
    { value: 12, label: "12th Grade"}
];
   
var SUBJECT_LEVEL_OPTIONS = [
    {value: 'english', label: 'English'},
    {value: 'math', label: 'Math'},
    {value: 'science', label: 'Science'},
    {value: 'socialstudies', label: 'Social Studies'},
    {value: 'art', label: 'Art'},
    {value: 'music', label: 'Music'}
];


var BootstrapErrorAlert = React.createClass({    
    render: function() {
        return (
            <div className='alert alert-warning'>
                <button
                    type="button"
                    className="close"
                    onClick={this.props.handleClose}
                >
                    &times;
                </button>
                <span className="glyphicon glyphicon-alert"></span>
                {this.props.message}
            </div>
        );
    }
});

var HIPCForm = React.createClass({
    getInitialState: function() {
        return {
            error: '',
            school: '', 
            grades: '',
            subjects: '',
            title: '',
            email: ''
        };
    },
    loadSchoolOptions: function(input, callback) {  
         $.ajax({
            url: this.props.api_host+'/api/schools/',
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({error: ''});
                
                var schoolOptions = $.map(data, function(d, i) {
                    return {value: d.id, label: d.name}
                })
                callback(null, {options: schoolOptions, complete: true});
            }.bind(this),
            error: function(xhr, status, err) {
                this.setState({error: 'Error loading school options'});
                
                callback(null, {options: [], complete: true});                
            }.bind(this)
        });
    },
    onSchoolChange: function(value) {
        this.setState({school: value});
    },
    onGradeChange: function(value) {
        this.setState({grades: value});
    },
    onSubjectChange: function(value) {
        this.setState({subjects: value});
    },
    onTitleChange: function(e) {
        this.setState({title: e.target.value});
    },
    onEmailChange: function(e) {
        this.setState({email: e.target.value});
    },
    validateData: function() {
        var school = this.state.school;
        if(!school) {
            throw 'You must select a school';
        }
    
        var grades = this.state.grades;
        if(grades === "") {
            throw 'You must select a grade';
        }
        if(grades == 'K') {
            grades = '0';
        }
      
        //var grades = $.map(grades_text.split(','), function(value, i) {
        //    return parseInt(value);
        //});

        var subjects = this.state.subjects;
        if(!subjects) {
            throw 'You must select a subject';
        }
        //var subjects = $.map(subjects_text.split(','), function(value, i) {
        //    return parseInt(value);
        //});

        var title = this.state.title.trim();
        if(!title) {
            throw 'You must enter a Flyer Title';
        }

        var email = this.state.email.trim();
        if(!email) {
            throw 'You must enter your Email Address';
        }
        
        return {
            school: school,
            grades: grades,
            subject: subjects,
            title: title,
            email: email
        };  
    },  
    handleSubscribe: function(e) {
        e.preventDefault();
        
        try {
            var data = this.validateData();
            
            $.ajax({
                url: this.props.api_host+'/api/flyers/subscribe/',
                data: data,
                method: 'POST',
                dataType: 'json',
                cache: false,
                success: function(data) {
                    this.setState({error: ''});
                    window.location = this.props.success_url;
                }.bind(this),
                error: function(xhr, status, err) {
                    this.setState({error: 'Error completing subscription'});
                }.bind(this)
            });            
        }
        catch(err) {
            this.setState({error: err});
        }
    },
    handleShowSample: function(e) {
        try {
            var data = this.validateData();
           
            $.ajax({
                url: this.props.api_host+'/api/flyers/sample/',
                data: data,
                method: 'POST',
                cache: false,
                success: function(data) {
                    this.setState({error: ''});
                    window.open("data:application/pdf,"+ escape(data), '_blank');

                }.bind(this),
                error: function(xhr, status, err) {
                    this.setState({error: 'Error generating sample'});
                }.bind(this)
            });
        }
        catch(err) {
            this.setState({error: err});        
        }
    },
    handleCloseAlert: function(e) {
        this.setState({error: ''});
    },
    render: function() {
        var alert = null;
        
        if(this.state.error) {
            alert = (
                <BootstrapErrorAlert 
                    message={this.state.error}
                    handleClose={this.handleCloseAlert}
                />
            );
        }
         
        return (
            <div>
                {alert}
                <form onSubmit={this.handleSubscribe}>
                    <div className="form-group">
                        <Select 
                            name="school" 
                            value={this.state.school}
                            placeholder="What school do you teach in?"
                            asyncOptions={this.loadSchoolOptions}
                            onChange={this.onSchoolChange}
                        />
                    </div>
                    <div className="form-group">
                        <Select 
                            name="grade" 
                            value={this.state.grades}
                            placeholder="What grade do you teach?"
                            multi={false}
                            options={GRADE_LEVEL_OPTIONS} 
                            onChange={this.onGradeChange}
                        />
                    </div>
                    <div className="form-group">
                        <Select 
                            name="subject" 
                            value={this.state.subjects}
                            placeholder="Which topics are your students interested in?"
                            multi={false}
                            options={SUBJECT_LEVEL_OPTIONS} 
                            onChange={this.onSubjectChange}
                        />
                    </div>
                    <div className="form-group">
                        <input 
                            type="text" 
                            className="form-control" 
                            name="title" 
                            value={this.state.title}
                            placeholder="How would you like to title your flyer?" 
                            onChange={this.onTitleChange}
                        />
                    </div>
                    <div className="form-group">
                        <input 
                            type="email" 
                            className="form-control" 
                            name="email" 
                            value={this.state.email}
                            placeholder="What's your email address?" 
                            onChange={this.onEmailChange}
                        />
                    </div>
                    <div className="form-group text-center">
                        <button type="submit" className="btn btn-subscribe">SUBSCRIBE</button>
                    </div>
                    <div className="form-group text-center">
                        <a href="javascript:;" onClick={this.handleShowSample}>View a Sample Flyer</a>
                    </div>
                </form>
            </div>
        );
    }
});


ReactDOM.render(
    <HIPCForm api_host='http://127.0.0.1:8000' success_url='thankyou.html' />,
    document.getElementById('hipcform')
);