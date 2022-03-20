import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})

export class ProfilePage implements OnInit {

  infos = {};
  setIndeterminateState: boolean;
  parentCheckbox: boolean;
  diseases: any;

  constructor() {
    this.diseases = [
      {
        value: 'Cholestérol',
        selected: false
      }, {
        value: 'Diabète',
        selected: false
      }, {
        value: 'Hypertension',
        selected: false
      },
      {
        value: 'Pas de maladie',
        selected: false
      }
    ];
  }

  onSelect() {
    setTimeout(() => {
      this.diseases.forEach(item => {
        item.selected = this.parentCheckbox;
      });
    });
  }

  onChange() {
    const checkboxes = this.diseases.length;
    let selected = 0;

    this.diseases.map(el => {
      if (el.selected) selected++;
    });

    if (selected > 0 && selected < checkboxes) {
      this.setIndeterminateState = true;
      this.parentCheckbox = false;
    } else if (selected == checkboxes) {
      this.parentCheckbox = true;
      this.setIndeterminateState = false;
    } else {
      this.setIndeterminateState = false;
      this.parentCheckbox = false;
    }
  }

  editForm() {
    console.log(this.infos);
  }

  ngOnInit() {
  }

}
