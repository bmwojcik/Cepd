# Cepd_PokemonIntegration module

<font color='red'>**The following example is a complete README for a module Cepd_PokemonIntegration:** </font>
# Cepd_PokemonIntegration module
The Cepd_PokemonIntegration module enables you to integrate with PokeApi and display custom data on product details.

The module adds the “Cepd” tab and the configuration wizard to the PokeAPi integration, like Endpoint.

Configuration is available `Stores > Configuration > Cepd > General`
### Cron

The module introduces cron group in the `pokeapi` and custom Cron Job `cepd_pokeapi_import_data`.

### Database

Custom table `cepd_pokemon_info` is created with PokemonId Unique Constraint

## Funcionality

- Functionality is enabled by default
- Once per day complete pokemon data is imported (00:00). Resource Connection instead of Repository is used, however due to small pack of data (~1000) both are good to use
- Custom GraphQL endpoint is used `https://beta.pokeapi.co/graphql/v1beta`
- Data stored in DB table prevents from unwanted API calls in frontend area
- Custom `pokemon` Product attribute - editable
- Pokemon Data is displayed on Category and Product Detail Page - name and image


### Personal thoughts (by author)
- Task does not specify which image should be displayed, and API returns a lot of various. I assumed to use the first found from `front_default`
- GraphQL endpoint is used, however the one provided in task could be used aswell.
- Task DOES NOT provide information about other places where Image is displayed - like products grid, checkout, order details etc.
- Data table is truncated and updated once per day to store most recent data
- I am aware that some points are missing from task, this is solution for logic Part.
