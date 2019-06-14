// multiple-datasets.css typeahead.js jQuery plugin Multiple Datasets

var nbaTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: '../data/nba.json'
});

var nhlTeams = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: '../data/nhl.json'
});

$('#multiple-datasets .typeahead').typeahead({
  highlight: true
},
{
  name: 'nba-teams',
  display: 'team',
  source: nbaTeams,
  templates: {
    header: '<h3 class="league-name">NBA Teams</h3>'
  }
},
{
  name: 'nhl-teams',
  display: 'team',
  source: nhlTeams,
  templates: {
    header: '<h3 class="league-name">NHL Teams</h3>'
  }
});
