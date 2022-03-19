import { Component, OnInit } from '@angular/core';
import { AngularFireDatabase } from '@angular/fire/compat/database';

@Component({
  selector: 'app-test',
  templateUrl: './test.page.html',
  styleUrls: ['./test.page.scss'],
})
export class TestPage implements OnInit {
  public toto;

  constructor(private readonly afDatabase: AngularFireDatabase) {}

  ngOnInit() {
    this.toto = this.afDatabase.object('/categories');
  }
}
