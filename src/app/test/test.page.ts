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
  public toto: any;
  public infos;
  constructor(private readonly afDatabase: AngularFireDatabase) {}

  ngOnInit() {
    this.toto = this.afDatabase.list('/categories');
    this.toto.valueChanges().subscribe((p: any) => {
      this.infos = p;
      console.log(this.infos);
    });
  }
}
