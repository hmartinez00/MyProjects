from module.w_tools import Reconocimiento, raspado

# ans = Reconocimiento()
# print(ans)

url = 'https://www.biblegateway.com/passage/?search=proverbios+3%3A5-6&version=RVR1960'
tags = raspado(url)
print(tags)