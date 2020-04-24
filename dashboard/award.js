function getOverallRanking(){
    $.ajax({
      url : "./results.json",
      success : function(result) {
        updateRankings(result);
      },
    })
  }    
  function trim(url){
    return url.split(' ').join('');
  }
    function updateRankings(ranks) {    
      //update first position
      var first = ranks[0];
      $('.first .name').text(first.nickname);
      $('.first .top-avatar').attr("src", `url(https://robohash.org/${trim(first.nickname+first.track)})`)
      $('.first .track').text(first.track);
      $('.first .points').text(first.score + ' points');
      // $('div.one').addClass(first.track);
  
      //update second Position
      var second = ranks[1];
      $('.second .name').text(second.nickname);
      $('.second .top-avatar').attr("src", `url(https://robohash.org/${trim(second.nickname+second.track)})`)
      $('.second .track').text(second.track);
      $('.second .points').text(second.score + ' points');
      // $('div.two').addClass(second.track);
  
      //update third position
      var third = ranks[2];
      $('.third .name').text(third.nickname);
      $('.third .top-avatar').attr("src", `url(https://robohash.org/${trim(third.nickname+third.track)})`)
      $('.third .track').text(third.track);
      $('.third .points').text(third.score + ' points');
      // $('div.three').addClass(third.track);
        
      //update the rest
      var starter = 4
      for (let i = 3; i < ranks.length; i++) {
        var markup =`<div class="person flex row">
        <span class="rank flex row"> ${starter} </span>
        <img src="https://robohash.org/${trim(ranks[i].nickname+ranks[i].track)}" style="width: 55px; height: 55px; margin-top: -12px;" alt="avatar">
        <div class="flx col">
         <div class="name">${ranks[i].nickname}</div>
         <div class="track ${ranks[i].track}">${ranks[i].track}</div>
        </div> 
        <div class="score"><span class="value">${ranks[i].score}</span> points</div>
       </div>`        
        $('.theRest').append(markup);
        starter++
      }
      var animationStyle = document.createElement('style');
      animationStyle.innerHTML = `
      @-webkit-keyframes podium_up {
        from {
         -webkit-transform: translateY(100%);
                 transform: translateY(100%);
        }
        to {
         -webkit-transform: translateY(0);
                 transform: translateY(0);
        }
       }
       
       @keyframes podium_up {
        from {
         -webkit-transform: translateY(100%);
                 transform: translateY(100%);
        }
        to {
         -webkit-transform: translateY(0);
                 transform: translateY(0);
        }
       }
       @-webkit-keyframes quickFade {
        from {
         opacity: 0;
         -webkit-transform: scale(1.3);
                 transform: scale(1.3);
        }
        to {
         opacity: 1;
         -webkit-transform: scale(1);
                 transform: scale(1);
        }
       }
       @keyframes quickFade {
        from {
         opacity: 0;
         -webkit-transform: scale(1.3);
                 transform: scale(1.3);
        }
        to {
         opacity: 1;
         -webkit-transform: scale(1);
                 transform: scale(1);
        }
       }
       @-webkit-keyframes normalFade {
        from {
         opacity: 0;
        }
        to {
         opacity: 1;
        }
       }
       @keyframes normalFade {
        from {
         opacity: 0;
        }
        to {
         opacity: 1;
        }
       }
       @-webkit-keyframes quickSpin {
        from {
         -webkit-transform: rotateZ(720deg);
                 transform: rotateZ(720deg);
         opacity: 0;
        }
        to {
         opacity: 1;
         -webkit-transform: rotateZ(0deg);
                 transform: rotateZ(0deg);
        }
       }
       @keyframes quickSpin {
        from {
         -webkit-transform: rotateZ(720deg);
                 transform: rotateZ(720deg);
         opacity: 0;
        }
        to {
         opacity: 1;
         -webkit-transform: rotateZ(0deg);
                 transform: rotateZ(0deg);
        }
       }
      `
      document.getElementById('startAnimate').appendChild(animationStyle)
    }
    getOverallRanking();
  //Rankings Array
  let ranks = JSON.parse(localStorage.getItem('ranks'));
  localStorage.removeItem('ranks');
  
  function filterRanks(filter) {
    const newRanks = ranks.filter(obj => obj.track == filter)
  
    console.log(newRanks);
    //updateRankings(newRanks);
  }  
  document.getElementById('filterform').onsubmit = (e)=>{
      e.preventDefault();
      let filter = document.getElementById('filter').value.split(' ').join('+');
      let completePageURL =  window.location.href.split('?'),
      actualURL = completePageURL[0];
      if (window.location.href === `${actualURL}?filter=${filter}`) {
        return true;
      } else{
        window.location.href = `leaderboard.php?filter=${filter}`
      }
  }
  
  const queryParam = new URLSearchParams(window.location.search).toString().split('=').pop();
  const id = queryParam.split('+').join(' ');
  const test = id;
  
  // document.getElementById(test).selected = true; n
  