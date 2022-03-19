import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
})

export class ProfilePage implements OnInit {

  infos = {};
  editForm() {
    console.log(this.infos);
  }

  ngOnInit() {
  }

}
