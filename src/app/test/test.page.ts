import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-test',
  templateUrl: './test.page.html',
  styleUrls: ['./test.page.scss'],
})
export class TestPage implements OnInit {
  public list: any;
  public categoriesName;
  constructor(private readonly afDatabase: AngularFireDatabase) {}

  ngOnInit() {
    this.list = this.afDatabase.list('/');
    this.list.valueChanges().subscribe((response: any) => {
      this.categoriesName = Object.keys(response[0]);
      console.log('BDD', response[0].meat);
    });
  }
}
