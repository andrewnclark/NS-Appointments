# NS-Appointments
All being well you should be able to clone this repository and run the following from the `laradock` directory:

`docker-compose up -d nginx mysql phpmyadmin redis workspace `

This should make the API available on appointments.test

## Tests
To run the test suite you can enter the VM with `docker-compose exec workspace bash`, `cd appointments`, `phpunit`

The test suite makes use of a in-memory SQLite database which is destroyed and migrated on each run. Each of the individual tests are ran in database transactions which are rolled back on completion, thus each individual test starts with an empty database.

## Overall Design
I opted to use Lumen over the Laravel framework as the spec was a stateless API and we don't need the over head of sessions and all of the framework components.

The authentication has been bound to an interface via the container and defaults to the standard Lumen auth which looks for an API Token in the request and matches it with a user record. Since no information was provided about the way you wish to authenticate users - this allow an easy switch to remote auth, JWT or other.

It was also not stated who owns the API - so User is considered an API user and not related to an appointment.

## Questionables (that a word?)
Mails should be logging but I've not been able to verify this, I ran out of time to write the neccessary tests.

Monitoring and logging has not been implemented but I would do so via Middleware, either at a global or per-route level. I'd use .env variables to toggle these features on and off.

Versioning is very rudimentary.

The data format of the API and the data stored on the models is also very rudimentary - I was unsure what to store and how much to store on the related models.

## Overall
I'm not that happy with the end result but I hope that I touched on enough areas to show how I would tackle this. My enviornment that I cobbled together is far from perfect - I can't get autocompletion out of my IDE as I dont have PHP on my machine and I haven't took the type to setup some of my typical tooling like PHP CS Fixer for automating code-formatting.

I haven't got as much done as I would have liked but I stuck to a TDD approach.
