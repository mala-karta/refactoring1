# refactoring1

Hi.

Code can be extended of classes implemented interfaces from /src/infrastructure/ folder.

Also you can set urls for bin and rate providers with the help of appropriate  methods.

Unit tests are at the /tests/unit folder.


During the work i found that in provider can response with 429 code, as i understand it is a protection from ddos. In this situation code print 0.
I hope you have at whitelist for testing that bin provider.
If not - it is a reason for making cache for bin provider responses (but code doesn't do it now).


