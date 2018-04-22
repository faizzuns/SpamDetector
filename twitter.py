import tweepy,json,requests
import sys
import re

auth = tweepy.OAuthHandler("FhMEiylVnYSivjrZFxEHJkHOI", "bcmjauunsUn2PjQpiN4U1hmT8cza9hBysqlviKhvpJkEjh3OsI")
auth.set_access_token("107885960-TxdBQEK8KYH7ABslbEiOpX4IxdmxjW6E2RbwJRGJ", "zKZ0yFicHZZVgaClgk4Wvu6dhjeKpDZmGLqbG3HJS60la")
api = tweepy.API(auth)

def arrayFail(pattern) :
  length = len(pattern)
  fail = [0 for x in range(length)]
  fail[0] = 0
  j = 0
  i = 1
  for i in range(length) :
    if (pattern[j]==pattern[i]) :
      fail[i] = j+1
      i += 1
      j += 1
    elif (j > 0) :
      j = fail[j-1]
    else :
      fail[i] = 0
      i += 1
  return fail

def KMP(pattern, text) :
  patternLength = len(pattern)
  textLength = len(text)

  fail = []
  fail = fail + arrayFail(pattern)
  i = 0
  j = 0

  for i in range(textLength) :
    if (pattern[j] == text[i]) :
      if (j == (patternLength-1)) :
        return True  # match the pattern
      i += 1
      j += 1
    elif (j > 0) :
      j = fail[j-1]
    else :
      i += 1
  return False  # no match at all
  
def buildLast(text,pattern):
	last = {}

	for i in range(len(text)):
		last[text[i]]=-1

	for i in range(len(pattern)):
		last[pattern[i]] = i
	return last


def boyer(teks,pattern):
	text= teks.lower()
	last = buildLast(text,pattern)
	n = len(text)
	m = len(pattern)
	i = m-1

	if ( i> n-1):
		return -1 # gaada pattern yang cocok karena panjang pattern > text

	j = m-1
	if (pattern[j] == text[i]):
		if (j==0):
			return i
		else:
			i= i-1
			j= j-1
	else:
		lo = last[text[i]]
		i = i+m - min(j, 1 + lo)
		j = m-1
	while (i<= n-1):
		if (pattern[j] == text[i]):
			if (j==0):
				return i
			else:
				i= i-1
				j= j-1
		else:
			lo = last[text[i]]
			i = i+m - min(j, 1 + lo)
			j = m-1
	return -1


if __name__ == "__main__":
    f=open("input.txt", "r")
    f1 = f.read().split('\n')
    print (f1)
    category = f1[0]
    searchKey = f1[1]
    spam = f1[2]
    query = api.user_timeline(screen_name=searchKey, count = 1000)
	
    data = {}
    data['text'] = []
	
    if (category == "kmp") :
        for tweet in query:
            sp = False
            if (KMP(spam.lower(), tweet.text.lower())) :
                sp = True
            data['text'].append({'test':tweet.text, 'spam':sp, 'username':tweet.user.screen_name})
            with open('data.txt', "w+") as outfile:
                json.dump(data, outfile)
    elif (category == "bm") :
        for tweet in query:
            sp = False
            if (boyer(tweet.text, spam) != -1) :
                sp = True
            data['text'].append({'test':tweet.text, 'spam':sp, 'username':tweet.user.screen_name})
            with open('data.txt', "w+") as outfile:
                json.dump(data, outfile)
    elif (category == "regex") :
        for tweet in query:
            sp = False
            if (re.search( spam, tweet.text, re.I)) :
                sp = True
            data['text'].append({'test':tweet.text, 'spam':sp, 'username':tweet.user.screen_name})
            with open('data.txt', "w+") as outfile:
                json.dump(data, outfile)
