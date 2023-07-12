## Backend Assignment

## Task
You were given a sample [Laravel][laravel] project which implements sort of a personal wishlist
where user can add their wanted products with some basic information (price, link etc.) and
view the list.

#### Refactoring
The `ItemController` is messy. Please use your best judgement to improve the code. Your task
is to identify the imperfect areas and improve them whilst keeping the backwards compatibility.

#### New feature
Please modify the project to add statistics for the wishlist items. Statistics should include:

- total items count
- average price of an item
- the website with the highest total price of its items
- total price of items added this month

The statistics should be exposed using an API endpoint. **Moreover**, user should be able to
display the statistics using a CLI command.

Please also include a way for the command to display a single information from the statistics,
for example just the average price. You can add a command parameter/option to specify which
statistic should be displayed.

## Open questions
Please write your answers to following questions.

> **Please briefly explain your implementation of the new feature**  

I created a service that handles getting the stats by calling a repository. Then i created a controller that uses this serivce and exposed it via api endpoint. After that i created a command which uses the same service to get the stats and print them within a table.

> **For the refactoring, would you change something else if you had more time?**  


I think the task don't have to get more changes due to its simplicty. We can do much more refactoring if we have a complex task, we will think about the best way to make it readable, maintainable, and extendable.
**But for the current task we can do the following**

1. we can use a single service for each operation but for the simplcty i used one service for all crud operations.
2. we should use a pagination instead of getting all items at once. this will make a performance issue if we have much more data.

## Running the project
This project requires a database to run. For the server part, you can use `php artisan serve`
or whatever you're most comfortable with.

You can use the attached DB seeder to get data to work with.

#### Running tests
The attached test suite can be run using `php artisan test` command.

[laravel]: https://laravel.com/docs/8.x
