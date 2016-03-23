'use strict';

import React, {Component} from 'react';
import {basename} from '../globals';
import {find, inRange} from 'lodash';

export default class EntryDetail extends Component {

  static contextTypes = {
    router: React.PropTypes.object.isRequired
  };

  constructor(props, context){
    props.params.id = parseInt(props.params.id);
    super(props, context);
    this.state = {
      id: 0,
      creator_id: 0,
      nickname: '',
      num_students: 0,
      photo: '',
      entry: '',
      avg_score: 0,
      num_votes: 0,
      admin_score: 0,
      key: 0
    };
  }

  componentDidMount(){
    //use entries from props, or do a fetch first?
    if(!this.props.entriesFetched) {
      return;
    }
    this.setEntryState(this.props);
  }

  componentWillReceiveProps(newProps) {
    this.setEntryState(newProps);
  }

  setEntryState(props) {
    let id = props.params.id;
    let entry = find(props.entries, e => {
      return e.id === id;
    });
    if(!entry) {
      //this.context.router.push('/admin');
      this.fetchEntry();
      return;
    }
    this.setState(entry);
    if(!entry.adminScoreFetched) {
      this.fetchAdminScoreForEntry(entry.id);
    }
  }

  fetchEntry(){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/classes/${this.props.params.id}`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let existingEntry = this.state;
        let entry = JSON.parse($data.target.response);
        existingEntry.key = entry.id;
        existingEntry.id = entry.id;
        existingEntry.creator_id = entry.creator_id;
        existingEntry.nickname = entry.nickname;
        existingEntry.num_students = entry.num_students;
        existingEntry.photo = entry.photo;
        existingEntry.entry = entry.entry;
        existingEntry.avg_score = entry.avg_score;
        existingEntry.num_votes = entry.num_votes;
        existingEntry.admin_score = 0;
        existingEntry.adminScoreFetched = false;
        this.setState({existingEntry});
        this.fetchAdminScoreForEntry(entry.id);
        console.log(`[App] Succesfully fetched entry`);
      } else {
        console.log(`[App] Could not retrieve entry`);
      }
    };
    request.send();
  }

  fetchAdminScoreForEntry(class_id){
    let request = new XMLHttpRequest();
    request.open('GET', `${basename}/api/classes/${class_id}/myscore`, true);
    request.onload = ($data) => {
      if (request.status === 200) {
        let myscore = $data.target.response;
        let existingEntry = this.state;
        if(existingEntry){
          existingEntry.admin_score = myscore;
          existingEntry.adminScoreFetched = true;
          this.setState({existingEntry});
        }
        console.log(`[App] Succesfully fetched score`, myscore);
      } else {
        console.log(`[App] Could not retrieve score`);
      }
    };
    request.send();
  }

  editScoreHandler(event){
    event.preventDefault();
    this.postScoreHandler(event);
  }

  postScoreHandler(event){
    event.preventDefault();
    let {score, headerScore, scoreForm} = this.refs;
    if(inRange(score.value, 1, 10)){
      let updateData = new FormData(scoreForm);
      let request = new XMLHttpRequest();
      request.open('POST', `${basename}/api/classes/${this.props.params.id}/scores`, true);
      request.onload = ($data) => {
        if (request.status === 201) {
          let existingEntry = this.state;
          existingEntry.admin_score = score.value;
          this.setState({existingEntry});
          headerScore.innerText = `Jouw Score: ${this.state.admin_score}`;
          score.value = '';
          console.log(`[Entry] Succesfully updated vote`, this.state.admin_score);
          this.forceUpdate();
          location.reload();
        } else {
          headerScore.innerText = `Failed to update`;
          console.log(`[Entry] Failed to update vote`, $data.response);
        }
      };
      request.send(updateData);
    }
  }

  renderEntryOptions(){

    let {admin} = this.props;
    let {admin_score} = this.state;
    if(admin.can_vote_winner){

      let buttonText = 'Score Aanpassen';
      let inputValue = admin_score;
      let onSubmitHandler = e => this.editScoreHandler(e);
      if(admin_score === 0){
        console.log('admin_score', admin_score);
        buttonText = 'Score Toevoegen';
        inputValue = '';
        onSubmitHandler = e => this.postScoreHandler(e);
      }

      return (
        <div className="score-info">
          <h2 ref="headerScore">Jouw Score: {inputValue}</h2>
          <form className="score-form" onSubmit={onSubmitHandler} ref="scoreForm">
            <input type="number" name="score" ref="score" maxLength="1" placeholder="X"/><span className="onTen">&frasl; 10</span>
            <input type="submit" value={buttonText} name="submit" ref="submit" className="btn-submit"/>
          </form>
        </div>
      );

    }
    return;

  }

  render() {

    let {nickname, entry, photo, num_students, avg_score, num_votes, school_name, firstname, lastname} = this.state;
    let photoBgStyle = { backgroundImage: `url(${basename}/assets/img/klasfotos/${photo})` };

    return (
      <section className="admin-page">
        <header><h1 className="page-header">{nickname} | Gemiddelde Score: {avg_score}</h1></header>
        <div className="page-content entry-detail">
          <section className="page-section entry-text">
            <header className="hidden"><h1>Klassikale Boekbespreking van {nickname}</h1></header>
            <p>{entry}</p>
          </section>
          <section className="page-section entry-data">
            <figure className="img" style={photoBgStyle}>&nbsp;</figure>
            <div className="class-data">
              <p className="class-nickname"><strong>Klasnaam:</strong> {nickname}</p>
              <p className="class-students"><strong>Aantal Studenten:</strong> {num_students}</p>
              <p className="class-school"><strong>School:</strong> {school_name}</p>
              <p className="class-teacher"><strong>Leerkracht:</strong> {firstname} {lastname}</p>
              <p className="class-average"><strong>Gemiddelde score:</strong> {avg_score} ({num_votes} stemmen)</p>
            </div>
            {this.renderEntryOptions()}
          </section>
        </div>
      </section>
    );

  }

}
