import React, { Component } from 'react';
import axios from 'axios';

const apiUrl = 'http://localhost:8000/api/search?lname=';

class Location extends Component {
    constructor(props) {
        super(props);
        this.state = {
            filterText: '',
            data: [],
            //currentBook: -1,
            isSubmited: false
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) { 
        this.setState({
            filterText: event.target.value
        })
    }

    handleSubmit(event) {
        const searchTerm = this.state.filterText;
        axios.get(`${apiUrl}${searchTerm}`)
             .then(response => {
                 this.setState({
                     data: response.data,
                     isSubmited: true,
                     //showDetail: false,
                     //showReviewForm: false
                 })
              })
             .catch(error => {
	          throw(error);
              });
        event.preventDefault();
    }

    render() {
        const {isSubmited, data} = this.state;
        let search_result = <div></div>;
        if (isSubmited) {
            search_result =  <Table data = {data} />;
        }
        return (
  	    <div>
                <div className="row">
                    <div className="col-xs-12 col-sm-12 col-md-12">
                        <br/>
                        <h2 className="d-block p-3 bg-secondary text-white">Location Search</h2>
                    </div>
                </div>
                <div className="row">
                    <div className="col-xs-12 col-sm-12 col-md-12">
                        <SearchBar filterText={this.state.filterText} onChange={this.handleChange} onSubmit={this.handleSubmit}/>
                    </div>
                </div>

                <div className="row">
                    <div className="col-xs-12 col-sm-12 col-md-12">
                        { search_result }
                    </div>     
                </div>
            </div>
        );
    }
}


const SearchBar =  ({
  filterText,
  onChange,
  onSubmit
}) => <form onSubmit={onSubmit} className="form-inline">
  <div className="form-group">
    <input
      type="text"
      value={filterText}
      onChange={onChange}
      className="form-control"
    />
  </div>
  <div className="form-group">
    <button type="submit" className="btn btn-success"><b>Search</b></button>
  </div>
</form>


const Table = ({data}) => <table id="tab" className="table table-striped">
   <thead><tr><th>Id</th><th>Location</th><th>PId</th><th>PName</th></tr></thead>
   <tbody>{data.map((item, i) => <Row key = {i} location = {item}/>)}</tbody>
   </table>

//const Row = ({location}) => <tr><td>{location.lid}</td><td>{location.name}</td><td>{location.pid}</td><td>{location.parent}</td></tr>
const Row = ({location}) => <tr><td>{location.l_id}</td><td>{location.l_name}</td><td>{location.p_id}</td><td>{location.p_name}</td></tr>


export default Location;
