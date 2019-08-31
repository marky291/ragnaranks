export default {
    "en": {
        "passwords": {
            "password": "Passwords must be at least eight characters and match the confirmation.",
            "reset": "Your password has been reset!",
            "sent": "We have e-mailed your password reset link!",
            "token": "This password reset token is invalid.",
            "user": "We can't find a user with that e-mail address."
        },
        "auth": {
            "failed": "These credentials do not match our records.",
            "throttle": "Too many login attempts. Please try again in {seconds} seconds."
        },
        "pagination": {
            "previous": "&laquo; Previous",
            "next": "Next &raquo;"
        },
        "review": {
            "creation": {
                "success": "Success, Your review is now Live!",
                "errors": {
                    "present": "You have already created a review for this listing."
                }
            },
            "comments": {
                "errors": {
                    "exists": "You have already created a comment on this review."
                }
            }
        },
        "profile": {
            "defaultName": "Default RO",
            "defaultMarkup": "# Welcome to RagnaRanks markdown editor!\n You can write something nice and descriptive with a huge amount of different formats!' [Guide](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)\n You can also use emojis copied from the web and paste them right here! 😍\n \n**Please utilize all the configuration options to allow us to maximize the potential of your listing(s)!**",
            "config": {
                "max_base_level": {
                    "name": "Max Base Level",
                    "describe": "The highest base level that can be achieved."
                },
                "max_job_level": {
                    "name": "Max Job Level",
                    "describe": "The highest job level that can be achieved."
                },
                "max_aspd": {
                    "name": "Max ASPD",
                    "describe": "Maximum attack speed. (Default 190, Highest allowed 199)"
                },
                "max_stats": {
                    "name": "Max Stats",
                    "describe": "The maximum stat parameter that can be selected."
                },
                "arrow_decrement": {
                    "name": "Unlimited Arrows",
                    "describe": "Are arrows/ammo consumed when used on a bow/gun?"
                },
                "undead_detect_type": {
                    "name": "Detect Undead",
                    "describe": "Does race or element consider someone undead?"
                },
                "attribute_recover": {
                    "name": "Attribute Recovery",
                    "describe": "Does HP recover if hit by an attribute that's the same as your own?"
                },
                "pk_mode": {
                    "name": "Player Killing",
                    "describe": "Weather player killing is promoted"
                },
                "episode": {
                    "name": "Episode Version",
                    "describe": "What version  does the emulator run on"
                },
                "cast_rate": {
                    "name": "Cast Rate",
                    "describe": "The rate of time it takes to cast a spell. (100 = 100%)"
                },
                "instant_cast": {
                    "name": "Instant Cast",
                    "describe": "At what point can you instant cast spells"
                },
                "delay_rate": {
                    "name": "Delay Rate",
                    "describe": "Delay time after casting. (100 = 100%)"
                },
                "castrate_dex_scale": {
                    "name": "Dex Required",
                    "describe": "Amount of DEX required before cast time is zero. (IE: Instant Cast)"
                },
                "vcast_stat_scale": {
                    "name": "vcast_stat_scale",
                    "describe": "Amount of (DEX*2+INT) before variable cast turn zero."
                },
                "base_exp_rate": {
                    "name": "Base EXP Rate",
                    "describe": "Rate at which base experience is given."
                },
                "job_exp_rate": {
                    "name": "Job EXP Rate",
                    "describe": "Rate at which job experience is given."
                },
                "quest_exp_rate": {
                    "name": "Quest EXP Rate",
                    "describe": "Rate of base/job experience given by NPCs."
                },
                "item_drop_common": {
                    "name": "Common Drops",
                    "describe": "The rate at which common ETC items are dropped. (Cards excluded)"
                },
                "item_drop_equip": {
                    "name": "Equip Drops",
                    "describe": "The rate at which equipment are dropped."
                },
                "item_drop_card": {
                    "name": "Card Drops",
                    "describe": "The rate at which cards are dropped."
                },
                "item_drop_treasure": {
                    "name": "Treasure Drops",
                    "describe": "Rate adjustment for Treasure Box drops."
                },
                "item_drop_common_mvp": {
                    "name": "MVP Common Drops",
                    "describe": "The rate at which common ETC items are dropped by MVPs. (Cards excluded)"
                },
                "item_drop_equip_mvp": {
                    "name": "MVP Equip Drops",
                    "describe": "The rate at which equipment are dropped by MVPs."
                },
                "item_drop_card_mvp": {
                    "name": "MVP Card Drops",
                    "describe": "The rate at which cards are dropped by MVPs."
                },
                "drops_by_luk": {
                    "name": "Influenced Drops",
                    "describe": "Does LUK stat affect the drops by absolute basis?"
                }
            },
            "scoreboards": {
                "score": {
                    "default": "N/A"
                }
            },
            "reviews": {
                "heading": "player reviews",
                "enticement": "be the first to write a review on this server listing"
            },
            "voting": {
                "heading": {
                    "pending": "You are voting for {name}",
                    "completed": "You have already voted for {name}",
                    "declined": "We could not process your vote right now!",
                    "finished": "You successfully voted on {name}!"
                },
                "spending": "You have {value} votes available to spend on this server!",
                "pending": "When you have decided to give this server your vote, you will not be able to give another vote for {hours} hours to any other server, this prevents mass voting and allows votes to have value on our ranking algorithm.",
                "completed": "Thanks for your interest in another vote to this server, however you must wait {hours} hours from your first vote before you can send another vote",
                "declined": "Sorry for the inconvenience, you can true voting later or get in touch with an administrator to make the problem aware.",
                "finished": "Your vote has been sent to this server, and will be applied for the next 7 days, you can continue to vote every {hours} hours, thank you for your continued support on behalf of RagnaRanks and {name}."
            },
            "buttons": {
                "save_server": "Save my new server listing",
                "update_server": "Update my server listing",
                "delete_server": "Delete this server listing"
            }
        },
        "validation": {
            "accepted": "The {attribute} must be accepted.",
            "active_url": "The {attribute} is not a valid URL.",
            "after": "The {attribute} must be a date after {date}.",
            "after_or_equal": "The {attribute} must be a date after or equal to {date}.",
            "alpha": "The {attribute} may only contain letters.",
            "alpha_dash": "The {attribute} may only contain letters, numbers, dashes and underscores.",
            "alpha_num": "The {attribute} may only contain letters and numbers.",
            "array": "The {attribute} must be an array.",
            "before": "The {attribute} must be a date before {date}.",
            "before_or_equal": "The {attribute} must be a date before or equal to {date}.",
            "between": {
                "numeric": "The {attribute} must be between {min} and {max}.",
                "file": "The {attribute} must be between {min} and {max} kilobytes.",
                "string": "The {attribute} must be between {min} and {max} characters.",
                "array": "The {attribute} must have between {min} and {max} items."
            },
            "boolean": "The {attribute} field must be true or false.",
            "confirmed": "The {attribute} confirmation does not match.",
            "date": "The {attribute} is not a valid date.",
            "date_equals": "The {attribute} must be a date equal to {date}.",
            "date_format": "The {attribute} does not match the format {format}.",
            "different": "The {attribute} and {other} must be different.",
            "digits": "The {attribute} must be {digits} digits.",
            "digits_between": "The {attribute} must be between {min} and {max} digits.",
            "dimensions": "The {attribute} has invalid image dimensions.",
            "distinct": "The {attribute} field has a duplicate value.",
            "email": "The {attribute} must be a valid email address.",
            "ends_with": "The {attribute} must end with one of the following: {values}",
            "exists": "The selected {attribute} is invalid.",
            "file": "The {attribute} must be a file.",
            "filled": "The {attribute} field must have a value.",
            "gt": {
                "numeric": "The {attribute} must be greater than {value}.",
                "file": "The {attribute} must be greater than {value} kilobytes.",
                "string": "The {attribute} must be greater than {value} characters.",
                "array": "The {attribute} must have more than {value} items."
            },
            "gte": {
                "numeric": "The {attribute} must be greater than or equal {value}.",
                "file": "The {attribute} must be greater than or equal {value} kilobytes.",
                "string": "The {attribute} must be greater than or equal {value} characters.",
                "array": "The {attribute} must have {value} items or more."
            },
            "image": "The {attribute} must be an image.",
            "in": "The selected {attribute} is invalid.",
            "in_array": "The {attribute} field does not exist in {other}.",
            "integer": "The {attribute} must be an integer.",
            "ip": "The {attribute} must be a valid IP address.",
            "ipv4": "The {attribute} must be a valid IPv4 address.",
            "ipv6": "The {attribute} must be a valid IPv6 address.",
            "json": "The {attribute} must be a valid JSON string.",
            "lt": {
                "numeric": "The {attribute} must be less than {value}.",
                "file": "The {attribute} must be less than {value} kilobytes.",
                "string": "The {attribute} must be less than {value} characters.",
                "array": "The {attribute} must have less than {value} items."
            },
            "lte": {
                "numeric": "The {attribute} must be less than or equal {value}.",
                "file": "The {attribute} must be less than or equal {value} kilobytes.",
                "string": "The {attribute} must be less than or equal {value} characters.",
                "array": "The {attribute} must not have more than {value} items."
            },
            "max": {
                "numeric": "The {attribute} may not be greater than {max}.",
                "file": "The {attribute} may not be greater than {max} kilobytes.",
                "string": "The {attribute} may not be greater than {max} characters.",
                "array": "The {attribute} may not have more than {max} items."
            },
            "mimes": "The {attribute} must be a file of type: {values}.",
            "mimetypes": "The {attribute} must be a file of type: {values}.",
            "min": {
                "numeric": "The {attribute} must be at least {min}.",
                "file": "The {attribute} must be at least {min} kilobytes.",
                "string": "The {attribute} must be at least {min} characters.",
                "array": "The {attribute} must have at least {min} items."
            },
            "not_in": "The selected {attribute} is invalid.",
            "not_regex": "The {attribute} format is invalid.",
            "numeric": "The {attribute} must be a number.",
            "present": "The {attribute} field must be present.",
            "regex": "The {attribute} format is invalid.",
            "required": "The {attribute} field is required.",
            "required_if": "The {attribute} field is required when {other} is {value}.",
            "required_unless": "The {attribute} field is required unless {other} is in {values}.",
            "required_with": "The {attribute} field is required when {values} is present.",
            "required_with_all": "The {attribute} field is required when {values} are present.",
            "required_without": "The {attribute} field is required when {values} is not present.",
            "required_without_all": "The {attribute} field is required when none of {values} are present.",
            "same": "The {attribute} and {other} must match.",
            "size": {
                "numeric": "The {attribute} must be {size}.",
                "file": "The {attribute} must be {size} kilobytes.",
                "string": "The {attribute} must be {size} characters.",
                "array": "The {attribute} must contain {size} items."
            },
            "starts_with": "The {attribute} must start with one of the following: {values}",
            "string": "The {attribute} must be a string.",
            "timezone": "The {attribute} must be a valid zone.",
            "unique": "The {attribute} has already been taken.",
            "uploaded": "The {attribute} failed to upload.",
            "url": "The {attribute} format is invalid.",
            "uuid": "The {attribute} must be a valid UUID.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": []
        },
        "homepage": {
            "card": {
                "review": {
                    "positive": "with excellent reviews",
                    "mediocre": "with mixed reviews",
                    "negative": "with negative reviews",
                    "fresh": "with no player reviews"
                },
                "rate": {
                    "official-rate": "Official Rate Server",
                    "low-rate": "Low Rate Server",
                    "mid-rate": "Mid Rate Server",
                    "high-rate": "High Rate Server",
                    "super-high-rate": "Super High Rate Server"
                }
            },
            "rate": {
                "all": {
                    "name": "Any Rates"
                },
                "official-rate": {
                    "name": "Official Rates"
                },
                "low-rate": {
                    "name": "Low Rates"
                },
                "mid-rate": {
                    "name": "Mid Rates"
                },
                "high-rate": {
                    "name": "High Rates"
                },
                "super-high-rate": {
                    "name": "Super High Rates"
                },
                "null": {
                    "name": "Unknown Rates"
                }
            },
            "mode": {
                "all": {
                    "name": "Any Mode",
                    "describe": "Do not filter with any specific mode."
                },
                "renewal": {
                    "name": "Renewal",
                    "describe": "This listing is based on renewal format"
                },
                "pre-renewal": {
                    "name": "Pre-Renewal",
                    "describe": "This listing is based on pre-renewal format"
                },
                "custom": {
                    "name": "Custom",
                    "describe": "This listing uses a custom format."
                },
                "classic": {
                    "name": "Classic",
                    "describe": "This listing uses a classic format"
                }
            },
            "tag": {
                "all": {
                    "name": "With any Tags",
                    "describe": "Do not filter by a specific tag."
                },
                "freebies": {
                    "name": "Freebies",
                    "describe": "Players can obtain starting items once they login or from Newbie NPC."
                },
                "gepard": {
                    "name": "Gepard Protection",
                    "describe": "This listing supports anti-bot and anti-hack software."
                },
                "guild-pack": {
                    "name": "Guild Pack",
                    "describe": "A guild can obtain a large amount of freebies for their members."
                },
                "pk-mode": {
                    "name": "PK Mode",
                    "describe": "Players are able to engage in player vs player in all areas except towns."
                },
                "mobile": {
                    "name": "Mobile",
                    "describe": "This server can be installed, played and enjoyed on Android Devices."
                },
                "frost": {
                    "name": "Frost",
                    "describe": "Players are affected by Freeze effect."
                },
                "no-donations": {
                    "name": "No Donations",
                    "describe": "Players are unable to obtain items through donation methods."
                },
                "instant-level": {
                    "name": "Instant Level",
                    "describe": "Players can chose a class and max out base and job levels instantly by login or by NPC."
                },
                "themed-server": {
                    "name": "Themed Server",
                    "describe": "A server that has a heavy theme and/or lots of roleplay and storytelling."
                },
                "grinding": {
                    "name": "Grinding",
                    "describe": "There is lots of time consuming tasks to accomplish and achieve."
                }
            },
            "order": {
                "rank": {
                    "name": "Sorted by Rank Position"
                },
                "name": {
                    "name": "Sorted by Server Name"
                },
                "created": {
                    "name": "Sorted by Date Added"
                }
            },
            "listings": {
                "none_found": "No Listings found with requested parameters."
            }
        }
    }
}
