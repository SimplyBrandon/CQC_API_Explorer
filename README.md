
# CQC API Explorer
### Technical Test - 2 hours
_Provides essentially a proxy for the Care Quality Commission's API endpoints that fetch providers from the CQC API. Included with this is a web panel of sorts that allows you to interact with the API._

The web panel allows you to search locally available providers and explore the API in a more user-friendly format (as opposed to JSON). You can also store providers received from the CQC API on-the-go, and view which providers are out of date.

The API endpoints provide a proxy of the CQC API, with the addition of hooking into the individual providers that are fetched and storing or updating them (if they're stored, but older than 1 week) locally.


## Installation

Set up is standard with any laravel project. Prepare an environment, move the source folder to that environment then...

```bash
  composer install
  php artisan serve (if necessary)
```
    
## Web Reference
```/``` - Web panel for searching stored providers and for exploring the CQC API via the paginated `/providers` endpoint

```/docs``` - **Unfinished** Swagger API Documentation 
## API Reference

#### Query the CQC API for a paginated format of all providers.

```http
  GET /api/providers
```

| Parameter | Type     | Description                | Example |
| :-------- | :------- | :------------------------- |:-----------
| `page`    | `integer` | `Page number for pagination` | `1` |

#### Get existing providers UUID and when they were last updated
This is used to provide functionality to the web panel, in showing outdated and updated providers.

```http
  GET /api/providers/existing
```

#### Get Provider

```http
  GET /api/providers/${uuid}
```

| Parameter | Type     | Description                               | Example |
| :-------- | :------- | :---------------------------------------- |:------- |
| `uuid`      | `string` | **Required**. UUID of the item to fetch.| `1-10000227676` |

#### Search Providers

```http
  GET /api/providers/search/${query}
```

| Parameter | Type     | Description                               |
| :-------- | :------- | :---------------------------------------- |
| `query`      | `string` | **Required**. Returns providers that match the query.|