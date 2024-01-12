
function getAllTeams(){
    return `{
        teams {
          name
        }
      }`
}

function getAllTeamsWithParticipants() {
    return `
      {
        teams {
          name
        pilot {
          first_name
          last_name
        }
        copilot {
          first_name
          last_name
        }
        car
        }
      }
      
    `;
  }


  function getAllPodiums() {
    return `
    {       
        rallies {
            name
            winner {
              name
            }
            second_place {
              name
            }
            third_place {
              name
            }
          }
        }
      
    `;
  }

  function getRallyByName(name) {
    return `{
      rally(name: "${name}") {
        name
        start_date
        location
        winner {
            name
        }
        second_place {
            name
        }
          third_place {
            name
        }
      }
    }`;
  }

  function getParticipantsByNames(request) {
    let filterString = "";
    let result = JSON.parse(request);
    if (result.firstname && result.lastname) {
      filterString = `participants(first_name: "${firstName}", last_name: "${lastName}")`;
    } else if (firstName) {
      filterString = `participants(first_name: "${firstName}")`;
    } else if (lastName) {
      filterString = `participants(last_name: "${lastName}")`;
    } else {
      filterString = 'participants'
    }
  
    return `{
      ${filterString} {
        first_name
        last_name
        birthday
      }
    }`;
  }
  
  function getTeamByName(teamName) {
    return `{
      team(name: "${teamName}") {
        name
        pilot {
          first_name
          last_name
        }
        copilot {
          first_name
          last_name
        }
        car
      }
    }`;
  }

  function getSeasonByYear(year){
    return `
      { season(year: ${year}) {
          year
          champion
          constructor_champion
          rallies {
            name
            winner {
              name
              pilot {
                first_name
              }
            }
          }
        }
      }
    `
  }
  
  
  
  