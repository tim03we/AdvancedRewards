# AdvancedRewards

AdvancedRewards is a reward plugin that allows you to pick up your rewards after a certain amount of time (this is set in the config).

# Commands

Command | Alias | Default
--------- | ------ | -------
/advancedrewards | reward | true

# Config
```
# When should one always be able to enter the /reward command?
# In Minutes! (Default = 1440 (24 Hours))
time: 1440

# Edit the messages when entering the command.
# {time} - Display the "time-format" message
# {hours} - Display the hours
# {minutes} - Display the minutes
# {seconds} - Display the seconds
messages:
    success: "You have successfully collected your reward."
    error: "You can only pick up your next reward in {time}"
    time-format: "{hours} hour(s), {minutes} minute(s) and {seconds} second(s)"

# What commands should be executed when the player enters /reward?
# {player} - The player who enters the command
rewards:
    - "give {player} stone 32"
    - "tell {player} You got your reward."
```

----------------

If problems arise, create an issue or write us on Discord.

| Discord |
| :---: |
[![Discord](https://img.shields.io/discord/427472879072968714.svg?style=flat-square&label=discord&colorB=7289da)](https://discord.gg/Ce2aY25) |
