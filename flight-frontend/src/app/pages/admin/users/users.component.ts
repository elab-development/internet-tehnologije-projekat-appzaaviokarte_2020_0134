import { Component, OnInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { UserService } from '../../../services/user.service';
import { UpdateUserDialogComponent } from '../../../dialogs/update-user-dialog/update-user-dialog.component';
import { AddUserDialogComponent } from '../../../dialogs/add-user-dialog/add-user-dialog.component';
import { MatTableDataSource } from '@angular/material/table';
import { Airport } from '../../../models/airport';
import { MatPaginator } from '@angular/material/paginator';
import { User } from '../../../models/user';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss'],
})
export class UsersComponent implements OnInit {
  users: any[] = [];
  filteredUsers: any[] = [];
  searchTerm: string = '';
  currentPage: number = 0;
  pageSize: number = 4;

  @ViewChild(MatPaginator) paginator: MatPaginator;

  constructor(private userService: UserService, public dialog: MatDialog) {}

  ngOnInit(): void {
    this.loadUsers();
  }

  loadUsers(): void {
    this.userService.getAllUsers().subscribe((data: any[]) => {
      this.users = data;
      this.filteredUsers = data;
      this.updatePage();
    });
  }

  applyFilter(): void {
    this.filteredUsers = this.users.filter(
      (user) =>
        user.username.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
        user.email.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
        user.role.toLowerCase().includes(this.searchTerm.toLowerCase())
    );
    this.updatePage();
  }

  onPaginate(event: any): void {
    this.currentPage = event.pageIndex;
    this.pageSize = event.pageSize;
    this.updatePage();
  }

  updatePage(): void {
    const startIndex = this.currentPage * this.pageSize;
    const endIndex = startIndex + this.pageSize;
    this.filteredUsers = this.users.slice(startIndex, endIndex);
  }

  onCreatingNewUser(): void {
    const dialogRef = this.dialog.open(AddUserDialogComponent);
    dialogRef.afterClosed().subscribe((result) => {
      if (result) {
        this.userService.createUser(result).subscribe(() => {
          this.loadUsers();
        });
      }
    });
  }

  onUpdate(user: any): void {
    const dialogRef = this.dialog.open(UpdateUserDialogComponent, {
      data: user,
    });
    dialogRef.afterClosed().subscribe((result) => {
      if (result) {
        this.userService.updateUser(user.user_id, result).subscribe(() => {
          this.loadUsers();
        });
      }
    });
  }

  onDelete(user: any): void {
    if (
      confirm(`Are you sure you want to delete the user "${user.username}"?`)
    ) {
      this.userService.checkUserName(user.username).subscribe((response) => {
        if (response.exists) {
          this.userService.deleteUser(user.user_id).subscribe(() => {
            this.loadUsers();
          });
        } else {
          alert(
            `The user "${user.username}" no longer exists in the database.`
          );
          this.loadUsers();
        }
      });
    }
  }
}
