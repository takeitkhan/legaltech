import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';

class HomeNavigationBar extends HookWidget {
  const HomeNavigationBar({Key? key, required this.onChange}) : super(key: key);

  final Function(int index) onChange;

  @override
  Widget build(BuildContext context) {
    final items = [
      BottomNavigationBarItem(
        icon: Image.asset(
          'assets/icons/home.png',
          width: 24,
          color: Colors.black,
        ),
        activeIcon: Image.asset(
          'assets/icons/home.png',
          width: 24,
        ),
        label: AppLocalizations.of(context)!.home,
      ),
      BottomNavigationBarItem(
        icon: Image.asset(
          'assets/icons/chat.png',
          width: 24,
          color: Colors.black,
        ),
        activeIcon: Image.asset(
          'assets/icons/chat.png',
          width: 24,
        ),
        label: AppLocalizations.of(context)!.chat,
      ),
      BottomNavigationBarItem(
        icon: Image.asset(
          'assets/icons/packages.png',
          width: 24,
          color: Colors.black,
        ),
        activeIcon: Image.asset(
          'assets/icons/packages.png',
          width: 24,
        ),
        label: AppLocalizations.of(context)!.packages,
      ),
      BottomNavigationBarItem(
        icon: Image.asset(
          'assets/icons/notification.png',
          width: 24,
          color: Colors.black,
        ),
        activeIcon: Image.asset(
          'assets/icons/notification.png',
          width: 24,
        ),
        label: AppLocalizations.of(context)!.notification,
      ),
    ];

    final activeIndex = useState(0);

    return SafeArea(
      child: Container(
        height: 80,
        margin: const EdgeInsets.symmetric(horizontal: 16).copyWith(
          bottom: 8,
        ),
        padding: const EdgeInsets.all(8),
        decoration: BoxDecoration(
          color: Theme.of(context).colorScheme.primary.withOpacity(0.25),
          borderRadius: BorderRadius.circular(24),
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.spaceAround,
          children: [
            for (var index = 0; index < items.length; index++)
              GestureDetector(
                onTap: () {
                  activeIndex.value = index;
                  onChange(index);
                },
                child: AnimatedContainer(
                  duration: const Duration(milliseconds: 200),
                  width: index == activeIndex.value ? 100 : 70,
                  decoration: BoxDecoration(
                    color: index == activeIndex.value
                        ? Theme.of(context).colorScheme.primary
                        : null,
                    borderRadius: BorderRadius.circular(24),
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      index == activeIndex.value
                          ? items[index].activeIcon
                          : items[index].icon,
                      if (items[index].label != null)
                        Padding(
                          padding: const EdgeInsets.only(top: 3),
                          child: Text(
                            items[index].label!,
                            style: Theme.of(context)
                                .textTheme
                                .labelMedium
                                ?.copyWith(
                                  color: index == activeIndex.value
                                      ? Colors.white
                                      : Colors.black,
                                ),
                            maxLines: 1,
                          ),
                        ),
                    ],
                  ),
                ),
              ),
          ],
        ),
      ),
    );
  }
}
